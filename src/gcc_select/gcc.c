// gcc: Shim to reinvoke "xcrun clang...."

#include <err.h>
#include <stdarg.h>
#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <unistd.h>
#include <util.h>
#include <sysexits.h>
#include <limits.h>
#include <mach-o/dyld.h>

static char *msprintf(const char *format, ...) {
  va_list args;
  char *str = NULL;
  va_start(args, format);
  vasprintf(&str, format, args);
  va_end(args);
  return str;
}

// Use xcode-select to find Xcode's DEVELOPER_DIR.
const char *getDeveloperDir(void) {
  FILE *xcselect = popen("/usr/bin/xcode-select -print-path 2> /dev/null", "r");
  if (!xcselect)
    err(EX_OSERR, "unable to run /usr/bin/xcode-select");
  const char *developer_dir = fparseln(xcselect, 0, 0, 0, 0);
  int result = pclose(xcselect);
  if (result != EX_OK)
    err(EX_OSERR, "/usr/bin/xcode-select failed");
  return developer_dir;
}

int main(int argc, char *argv[])
{
  char *xcrun_path = "/usr/bin/xcrun";

  // ICC invokes "gcc --print-search-dirs" to find where to look for gcc's
  // headers and for libgcc.a.  Adjust the output from clang to make it
  // work for ICC.
  if (argc >= 2 && !strcmp(argv[1], "--print-search-dirs")) {
    // Run "clang --print-search-dirs".
    const char *clangcmd = msprintf("%s clang --print-search-dirs", xcrun_path);
    FILE *clangpaths = popen(clangcmd, "r");
    if (!clangpaths)
      err(EX_OSERR, "unable to launch clang");
    const char *programpath = fparseln(clangpaths, 0, 0, 0, 0);
    const char *libpath = fparseln(clangpaths, 0, 0, 0, 0);
    int result = pclose(clangpaths);
    if (result != EX_OK)
      err(EX_OSERR, "failed to read search-dirs from clang");

    const char *developer_dir = getDeveloperDir();
    fprintf(stdout, "install: %s/usr/lib/llvm-gcc/4.2.1\n", developer_dir);
    fprintf(stdout, "%s\n", programpath);
    // Append to the library path the directory where we've stashed a dummy
    // copy of libgcc.a to keep ICC happy.
    fprintf(stdout, "%s:%s/usr/lib/llvm-gcc/4.2.1\n", libpath, developer_dir);
    exit(0);
  }

  // ICC invokes "gcc -v" to find where to look for libstdc++ headers.
  // As a temporary workaround, emit an extra line of output to make it work.
  if (argc == 2 && (!strcmp(argv[1], "-v") || !strcmp(argv[1], "--version"))) {
    // Prepend the "--prefix" and "--with-gxx-include-dir" settings that
    // ICC looks for.
    const char *developer_dir = getDeveloperDir();
    const char *sysroot = getenv("SDKROOT");
    if (!sysroot || !strcmp(sysroot, "/"))
      sysroot = "";
    fprintf(stderr, "Configured with: --prefix=%s/usr "
            "--with-gxx-include-dir=%s%s\n",
            developer_dir, sysroot, "/usr/include/c++/4.2.1");
    fflush(stderr);
    // Continue to exec "clang -v" for the rest of its info....
  }

  // Set up the arguments for: xcrun clang ...
  char **args = malloc((argc + 2) * sizeof(char *));
  if (!args)
    err(EX_OSERR, "malloc");
  args[0] = xcrun_path;
  unsigned namelen = strlen(argv[0]);
  if (argv[0][namelen-1] == '+' && argv[0][namelen-2] == '+')
    args[1] = "clang++";
  else
    args[1] = "clang";
  int i;
  for (i = 1; i < argc; ++i)
    args[i+1] = argv[i];
  args[i+1] = 0;

#ifdef DEBUG
  for (i = 0; i < argc+1; ++i)
    printf("%s\n", args[i]);
#endif

  execv(xcrun_path, args);
  err(EX_OSERR, "failed to exec xcrun %s", xcrun_path);
}
