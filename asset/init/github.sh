
 ## op-skeleton-model:/asset/init/github.sh
 #
 # @created    ????
 # @license    Apache-2.0
 # @package    op-skeleton
 # @subpackage model
 # @copyright  (C) 2020 Tomoaki Nagahara
 #

# user name
USER_NAME=${1}

# Check argument.
if [ -z "$USER_NAME" ]; then
  echo 'Empty github accout name: sh asset/init/github.sh [YOUR ACCOUNT NAME]'
  exit 1
fi

# Copy backup.
cp .gitmodules .gitmodules_origin

# Replace
sed -i -e "s/onepiece-framework/${USER_NAME}/g" .gitmodules

# Sync
git submodule sync

# Notice
echo "\nNOTICE: This script does not support nested submodules.\n\n";