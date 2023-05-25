#!/bin/bash

#Create a user called banana_user and give it sudo permission and set its password to banana123
echo "Type in banana123 for password"
echo "Type in banana123 for password"
echo "Type in banana123 for password"
echo "Type in banana123 for password"
echo "Type in banana123 for password"
echo "Type in banana123 for password"
useradd -m -s /bin/bash banana_user
passwd banana_user
echo "banana_user ALL=(ALL) ALL" >> /etc/sudoers


#Install and configure vsftpd so that banana_user can simply sign in to ftp with their password and then and upload files.
sudo apt update
apt-get install vsftpd
systemctl enable vsftpd
systemctl start vsftpd
systemctl stop vsftpd

sudo sed -i 's/#write_enable=YES/write_enable=YES/' /etc/vsftpd.conf
systemctl start vsftpd
service vsftpd restart

#Create a private key that the user can use to connect on ssh without a password.
mkdir -p /home/banana_user/.ssh
echo "Just hit enter when prompted for a password"
echo "Just hit enter when prompted for a password"
echo "Just hit enter when prompted for a password"
echo "Just hit enter when prompted for a password"
echo "Just hit enter when prompted for a password"
echo "Just hit enter when prompted for a password"
ssh-keygen -t rsa -f /home/banana_user/.ssh/id_rsa
cat /home/banana_user/.ssh/id_rsa.pub >> /home/banana_user/.ssh/authorized_keys
chmod 644 /var/log/vsftpd.log