#!/bin/bash
# https://github.com/olivergondza/bash-strict-mode
set -euo pipefail
trap 's=$?; echo >&2 "$0: Error on line "$LINENO": $BASH_COMMAND"; exit $s' ERR
DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" >/dev/null && pwd )"

# Get the folder that is the root of this repo
folder="$(dirname "${DIR}")"
if [ -d "${folder}/docs" ]; then
    folder="${folder}/docs"
fi

echo "DIR: ${DIR}"
echo "folder: ${folder}"

# Install the version of Bundler.
if [ -f "${folder}/Gemfile.lock" ] && grep "BUNDLED WITH" "${folder}/Gemfile.lock" > /dev/null; then
    cat "${folder}/Gemfile.lock" | tail -n 2 | grep -C2 "BUNDLED WITH" | tail -n 1 | xargs gem install bundler -v
fi

# If there's a Gemfile, then run `bundle install`
# It's assumed that the Gemfile will install Jekyll too
if [ -f "${folder}/Gemfile" ]; then
    bundle install --gemfile="${folder}/Gemfile"
fi

# Attempt to serve the Jekyll site with livereloading
if command -V "bundle" &> /dev/null; then
    cd "${folder}"
    bundle exec jekyll serve --livereload --incremental
fi
