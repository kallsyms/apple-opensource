#!/bin/sh
#
# Copyright (c) 2012-2016 Apple Inc.
#
# Tests for regressions found by Apple Inc. for issues that upstream does not
# want to fix or accept tests for.


test_description='Apple Inc. specific tests'

. ./test-lib.sh

TESTROOT=$(pwd)

# <rdar://problem/10238070>
#
# This test case addresses a regression introduced between v1.7.3 and v1.7.5
# git bisect good v1.7.3
# git bisect bad v1.7.5
# ...
# found 18e051a3981f38db08521bb61ccf7e4571335353

test_expect_success '<rdar://problem/10238070> -- git add of a path that contains a .git directory' '
	rm -rf .git &&
	mkdir -p orig/sub/dir/otherdir &&
	cd orig/sub &&
	echo "1" > dir/file &&
	echo "2" > dir/otherdir/file &&
	git init --quiet &&
	git add -A &&
	git commit -m "Initial Commit" --quiet &&
	cd - > /dev/null &&
	git init --bare --quiet "${TESTROOT}/git_dir.git" &&
	git --git-dir="${TESTROOT}/git_dir.git" --work-tree=/ add -f -- "${TESTROOT}/orig/sub/" &&
	git --git-dir="${TESTROOT}/git_dir.git" --work-tree=/ add -f -- "${TESTROOT}/orig/" &&
	git --git-dir="${TESTROOT}/git_dir.git" --work-tree=/ commit -m "Commit." |
		grep -q "2 files changed, 2 insertions"
'

test_done
