// ld: Shim to reinvoke "xcrun ld...."

#include <err.h>
#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <unistd.h>
#include <sysexits.h>

int main(int argc, char *argv[])
{
  char *xcrun_path = "/usr/bin/xcrun";

  // Set up the arguments for: xcrun ld ...
  char **args = malloc((argc + 2) * sizeof(char *));
  if (!args)
    err(EX_OSERR, "malloc");
  args[0] = xcrun_path;
  args[1] = "ld";
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
