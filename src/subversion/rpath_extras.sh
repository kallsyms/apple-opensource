#!/bin/sh
set -e

[ -n "$DSTROOT" ] || exit 1
[ -n "$DEVELOPER_INSTALL_DIR" ] || exit 1
[ -n "$RPATHVERS" ] || exit 1

for dylib in "$DSTROOT""$RPATHVERS"/*.dylib; do
	if [ ! -L "$dylib" ]; then
		old_name=`otool -D "$dylib" | sed "1d"`
		new_name=`echo "$old_name" | sed "s|${DEVELOPER_INSTALL_DIR}/Library|@rpath|"`

		# fix LC_ID_DYLIB
		install_name_tool -id "$new_name" "$dylib"

		# fix LC_LOAD_DYLIB entries in other binaries
		for file in "$DSTROOT""$RPATHVERS"/../auto/SVN/*/*.bundle; do
			install_name_tool -change "$old_name" "$new_name" "$file"
		done
	fi
done

for bundle in "$DSTROOT""$RPATHVERS"/../auto/SVN/*/*.bundle; do
	RPATH_DEVELOPER_DIR="@loader_path/../../../../../../.."

	# add LC_RPATH entry
	install_name_tool -add_rpath "${RPATH_DEVELOPER_DIR}/Library" "$bundle"
	install_name_tool -add_rpath "${RPATH_DEVELOPER_DIR}/usr/lib" "$bundle"

	# For compatibility with existing serf.  This should be removed once serf has landed <rdar://problem/35366199>
	install_name_tool -add_rpath "${RPATH_DEVELOPER_DIR}/usr" "$bundle"
done
