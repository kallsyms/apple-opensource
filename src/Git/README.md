# Git

This project contains git from http://git-scm.com with some minor modifications

## Apple Specific Changes

  * Update .gitignore for case insensitive filesystems
  * Report Apple project version in --version output
  * Reword error message when requesting HTML documentation
  * Always list opendiff as an option for mergetool/difftool
  * Support Xcode.app-bundled gitattributes
  * Support Xcode.app-bundled gitconfig
  * Test suite updates
      * Regression test for <[rdar://problem/10238070](rdar://problem/10238070)>
      * Disable tests that are broken on OS X

## Updating from upstream

Ideally, you have a git remote setup for git://git.kernel.org/pub/scm/git/git.git
If you do not, then do this:

    git remote add cabal git@github.com:git/cabal.git
    git remote add upstream git://git.kernel.org/pub/scm/git/git.git
    git remote add upstream-htmldocs git://git.kernel.org/pub/scm/git/git-htmldocs.git
    git remote add upstream-manpages git://git.kernel.org/pub/scm/git/git-manpages.git
    
Fetch all remotes:
    git fetch --all

Once it is setup, then:

    git merge -X subtree=src/git $RELEASE_TAG
    $EDITOR Git.plist
    git commit --amend Git.plist
    
To find the latest tags:
    git ls-remote --tags
    
In case the conflict is difficult to resolve, Jeremy hosts his changes
compared to base OSS Git at: https://github.com/jeremyhu/git/commits/master 

Unfortunately, the generated man pages and html documentation are not tagged.
Check `git log upstream-manpages/master` and `git log upstream-htmldocs/master`
for relevant commit hashes and merge them into the tree:

    git merge -X subtree=src/git-manpages <man pages hash>
    git merge -X subtree=src/git-htmldocs <htmldocs hash>
    
Edit the Git.plist contents for version and import date.

## Building

This assumes you have setup [AMFITrustedKeys](https://confluence.sd.apple.com/display/TrustedExecution/How+To%3A+Use+AMFITrustedKeys):

    xbs buildit . -project Git-999 -release $TRAIN -archive -dsymsInDstroot -codesign -codesignIdentity "Apple Engineer:" -codesignKeychain $KEYCHAIN_PATH -codesignPassword $KEYCHAIN_PASS

Alternatively, if you disable codesign validation (ie: 'amfi=-1 cs_enforcement_disable=1' in boot-args), you can build without signing:

    xbs buildit . -project Git-999 -release $TRAIN -archive -dsymsInDstroot

## Installing

    sudo darwinup -f install /tmp/Git-999.roots/Archives/Shared_Git-999_DSTROOT_osx.tar.gz (or whatever the result of archiving with xbs is)

## Testing

The easiest way to test is to just use prove from the t directory (which you might need to chown to yourself):

    export GIT_TEST_INSTALLED=/Library/Developer/CommandLineTools/usr/bin
    cd /tmp/Git-999_git.roots/BuildRecords/Git-999_install/TempContent/Objects/x86_64/t
    sudo chown -R $(whoami) .
    prove -j $(sysctl -n hw.activecpu) --timer --state=failed,save ./t[0-9]*.sh

Note: If all tests fail, you may need to chown the directory:

    sudo chown -R $(whoami) .

## Submission

To submit to B&I, create a tag for the next version (eg: Git-120), push the tag to stash, then use submitproject:

    git tag -a Git-<VER>
    git push origin Git-<VER>
    xbs submitproject -git -url ssh://git@stash.sd.apple.com/devtools/git.git -tag Git-<VER> <TRAIN>
