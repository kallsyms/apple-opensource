#!/usr/bin/env python3
import subprocess
import requests
from bs4 import BeautifulSoup as BS

SITE_ROOT = 'https://opensource.apple.com/'
releases = BS(requests.get(SITE_ROOT).content)

macos_release = releases.find(lambda t: t.name == 'a' and t.get('href', '').startswith('/release/macos'))['href']

pkgs_page = BS(requests.get(SITE_ROOT + macos_release).content)

pkg_tags = pkgs_page.findAll(lambda t: t.name == 'a' and t.get('href', '').endswith('.tar.gz'))

pkgs = [SITE_ROOT + pkg['href'] for pkg in pkg_tags]

# Easier to do in sh
subprocess.call(["./extract.sh", *pkgs])
