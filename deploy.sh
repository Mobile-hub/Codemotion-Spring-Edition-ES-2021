#!/usr/bin/env bash

aws --version >/dev/null 2>&1 || { echo >&2 "I require AWS Cli but it's not installed. ¯\_(ツ)_/¯ Aborting."; exit 1; }


# Environment vars
export AWS_PAGER=""
export AWS_DEFAULT_REGION=eu-west-1

FILE=iac/template.yaml
STACK_NAME=jamstack-site.yaml

aws cloudformation deploy \
  --template-file ${FILE} \
  --stack-name ${STACK_NAME} \
  --capabilities CAPABILITY_NAMED_IAM \
  ${PARAMETERS:---parameter-overrides Param="None"}	\
  --tags \
  Project=JamStack

