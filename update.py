#!/usr/bin/env python3
import subprocess
import requests
from bs4 import BeautifulSoup as BS

SITE_ROOT = 'https://opensource.apple.com/'
releases = BS(requests.get(SITE_ROOT).content)

pkgs = []

for rel_prefix in ['/release/macos', '/release/developer-tools', '/release/ios']:
    release = releases.find(lambda t: t.name == 'a' and t.get('href', '').startswith(rel_prefix))['href']
    pkgs_page = BS(requests.get(SITE_ROOT + release).content)
    pkg_tags = pkgs_page.findAll(lambda t: t.name == 'a' and t.get('href', '').endswith('.tar.gz'))
    pkgs.extend(SITE_ROOT + pkg['href'] for pkg in pkg_tags)

with open('log', 'r') as log:
    old_pkgs = set(log.read().split('\n'))

pkgs = [p for p in pkgs if p not in old_pkgs]

with open('log', 'a') as log:
    for pkg in pkgs:
        log.write(pkg + "\n")

# Easier to do in sh
subprocess.call(["./extract.sh", *pkgs])
