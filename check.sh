#!/usr/bin/env bash

clear

docker --version >/dev/null 2>&1 || { echo >&2 "I require docker but it's not installed. ¯\_(ツ)_/¯ Aborting."; exit 1; }
docker-compose --version >/dev/null 2>&1 || { echo >&2 "I require docker-compose but it's not installed. ¯\_(ツ)_/¯ Aborting."; exit 1; }
node --version >/dev/null 2>&1 || { echo >&2 "I require node.js vm but it's not installed. ¯\_(ツ)_/¯ Aborting."; exit 1; }
npm --version >/dev/null 2>&1 || { echo >&2 "I require npm package manager but it's not installed. ¯\_(ツ)_/¯ Aborting."; exit 1; }
gatsby --version >/dev/null 2>&1 || { echo >&2 "I require gatsby-cli (node package) but it's not installed. ¯\_(ツ)_/¯ Aborting."; exit 1; }
hs --version >/dev/null 2>&1 || { echo >&2 "I require http-server (node package) but it's not installed. ¯\_(ツ)_/¯ Aborting."; exit 1; }

echo "\n▂▃▅▇█▓▒░ Mission Accomplished: You are ready for the next step! ░▒▓█▇▅▃▂\n"
