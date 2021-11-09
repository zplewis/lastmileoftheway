#!/bin/bash
# https://github.com/olivergondza/bash-strict-mode
# Exit when a command fails
set -o errexit
# Exit when any command in a pipeline returns a failure code
set -eu pipefail
# Exit when the script tries to use undeclared variables
set -o nounset

DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" >/dev/null && pwd )"

# Get the folder that is the root of this repo
folder="${DIR}"

if [[ "${folder}" == *"/.devcontainer" ]]; then
    folder="$(dirname "${DIR}")"
fi

if [ -d "${folder}/docs" ]; then
    folder="${folder}/docs"
fi

echo "DIR: ${DIR}"
echo "folder: ${folder}"

# Install the version of Bundler.
if [ -f "${folder}/Gemfile.lock" ] && grep "BUNDLED WITH" "${folder}/Gemfile.lock" > /dev/null; then
    version=$(cat "${folder}/Gemfile.lock" | tail -n 2 | grep -C2 "BUNDLED WITH" | tail -n 1)
    gem install bundler -v "${version}"
fi

# If there's a Gemfile, then run `bundle install`
# It's assumed that the Gemfile will install Jekyll too
if [ -f "${folder}/Gemfile" ]; then
    bundle install --gemfile="${folder}/Gemfile"
fi

# Attempt to serve the Jekyll site with livereloading
if command -V "bundle" &> /dev/null; then
    cd "${folder}"
    bundle exec jekyll serve --watch --incremental
fi
