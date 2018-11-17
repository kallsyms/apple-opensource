#!/bin/bash
set -e

echo "Clearing existing sources"
rm -rf src
mkdir src

for pkg in "$@"
do
    fp="$(mktemp --suffix='.tar.gz')"
    echo "Downloading ${pkg}"
    wget --quiet "${pkg}" -O "${fp}"
    tar -xf "${fp}" -C "src" 
    rm "${fp}"
    sleep 5
done

if [ -n "$(git status --porcelain)" ]; then
    git add -A
    git commit -m "$(date +%Y-%m-%d)"
    git push
fi
