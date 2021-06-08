#!/bin/bash
sudo mv public public_html
sed -i 's/DEVELOPMENT/PRODUCTION/g' app/bootstrap.php