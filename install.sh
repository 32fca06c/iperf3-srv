#!/bin/bash
sudo dnf install nginx php-fpm -y
sudo sed -i -e 's,user = apache,user = nginx,g' -e 's,group = apache,group = nginx,g' /etc/php-fpm.d/www.conf
sudo chmod 777 /home/adner
sudo systemctl daemon-reload
sudo systemctl enable --now iperf3.service
sudo systemctl enable --now php-fpm.service
sudo systemctl enable --now nginx.service
