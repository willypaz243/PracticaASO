#Install vsftpd
zypper install vsftpd
systemctl start vsftpd
systemctl enable vsftpd
groupadd ftpg

# create defauld user
if ! id "ftpuser" &>/dev/null; then
    useradd -g ftpg -d /srv/ftp ftpuser
    echo "Ingrese contraseña para el usuario `ftpuser`"
    passwd ftpuser
fi
# give permissions
chmod 770 /srv/ftp
chown ftpuser:ftpg /srv/ftp
# ftp config
cp ./vsftpd.conf /etc/ftp/
systemctl restart vsftpd

# add port to ftp
firewall-cmd --add-port=21/tcp --permanent
firewall-cmd --add-port=30000-30100/tcp --permanent
firewall-cmd --reload

# Instalar apache2
zypper install apache2
systemctl start apache2
systemctl enable apache2

# Instalar php7
zypper install php7 apache2-mod_php7
# enable php modules 
a2enmod php7
# copy php code to apache htdocs
cp ./index.php /srv/www/htdocs/
# enable apache2 service
systemctl restart apache2

# install mysql
zypper install mariadb
systemctl start mysql
systemctl enable mysql
zypper install php7-mysql
mysql -u root -p '' aso_practice < mysqlInit.sql



# install a c/Client

# c/client dependencies
# zypper install php7-curl
