#!/bin/bash
sudo mv public_html public
sed -i 's/PRODUCTION/DEVELOPMENT/g' app/bootstrap.php