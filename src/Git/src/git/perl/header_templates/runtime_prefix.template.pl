# BEGIN XCODE RUNTIME_PREFIX generated code
BEGIN {
    use File::Spec;
    my $PERLVERSION = "@@PERLVERSION@@";
    if ($^V =~ m/v([0-9]+).([0-9]+)/) {
        $PERLVERSION = $1.".".$2;
    }
    my $__prefix = File::Spec->rel2abs( __FILE__ );

    if ($__prefix =~ m/\/libexec\/git-core\// ) {
        $__prefix =~ s/\/libexec\/git-core\/.*//;
        unshift @INC, $__prefix . "/share/git-core/perl";
        unshift @INC, $__prefix . "/../Library/Perl/".$PERLVERSION."/darwin-thread-multi-2level";
    } elsif ($__prefix =~ m/\/bin\// ) {
        $__prefix =~ s/\/bin\/.*//;
        unshift @INC, $__prefix . "/share/git-core/perl";
        unshift @INC, $__prefix . "/../Library/Perl/".$PERLVERSION."/darwin-thread-multi-2level";
    } elsif ( $__prefix =~ m/\/usr\// ) {
        $__prefix =~ s/\/usr\/.*/\/usr/;
        unshift @INC, $__prefix . "/share/git-core/perl";
        unshift @INC, $__prefix . "/../Library/Perl/".$PERLVERSION."/darwin-thread-multi-2level";
    }
}
# END XCODE RUNTIME_PREFIX generated code.

# BEGIN RUNTIME_PREFIX generated code.
#
# This finds our Git::* libraries relative to the script's runtime path.
sub __git_system_path {
	my ($relpath) = @_;
	my $gitexecdir_relative = '@@GITEXECDIR_REL@@';

	# GIT_EXEC_PATH is supplied by `git` or the test suite.
	my $exec_path;
	if (exists $ENV{GIT_EXEC_PATH}) {
		$exec_path = $ENV{GIT_EXEC_PATH};
	} else {
		# This can happen if this script is being directly invoked instead of run
		# by "git".
		require FindBin;
		$exec_path = $FindBin::Bin;
	}

	# Trim off the relative gitexecdir path to get the system path.
	(my $prefix = $exec_path) =~ s/\Q$gitexecdir_relative\E$//;

	require File::Spec;
	return File::Spec->catdir($prefix, $relpath);
}

BEGIN {
	use lib split /@@PATHSEP@@/,
	(
		$ENV{GITPERLLIB} ||
		do {
			my $perllibdir = __git_system_path('@@PERLLIBDIR_REL@@');
			(-e $perllibdir) || die("Invalid system path ($relpath): $path");
			$perllibdir;
		}
	);

	# Export the system locale directory to the I18N module. The locale directory
	# is only installed if NO_GETTEXT is set.
	$Git::I18N::TEXTDOMAINDIR = __git_system_path('@@LOCALEDIR_REL@@');
}

# END RUNTIME_PREFIX generated code.
