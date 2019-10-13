#!/bin/bash
set -ueo pipefail

for pkg in "$@"
do
    echo "Downloading ${pkg}"
    tarball=$(echo "${pkg##*/}")
    pkg_name=$(echo "${tarball}" | cut -d'-' -f1)
    save_dir="src/${pkg_name}"

    wget --quiet "${pkg}"
    rm -rf "${save_dir}"
    mkdir -p "${save_dir}"

    tar -xf "${tarball}" -C "${save_dir}" --strip-components=1

    rm "${tarball}"
done

if [ "${GITHUB_ACTION+x}" ]; then
    git checkout master
    git remote set-url origin "https://x-access-token:${GITHUB_TOKEN}@github.com/${GITHUB_REPOSITORY}"
fi

if [ -n "$(git status --porcelain)" ]; then
    git config user.email "opensource@apple.com"
    git config user.name "Apple Open Source"
    git add src
    git commit -m "$(date +%Y-%m-%d)"
    git push
fi
