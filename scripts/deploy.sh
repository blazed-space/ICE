#!/bin/bash

# This script is to be run on a site upon deployment
# (c) Blazed Labs LLC blazedlabs.com

sudo rm public_html/index.php
sudo mv 'public_html/index_deploy.php' 'public_html/index.php' 
