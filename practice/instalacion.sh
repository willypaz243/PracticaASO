#Install vsftpd
zypper install -y vsftpd
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
chmod 774 /srv/ftp
chown ftpuser:ftpg /srv/ftp
# ftp config
mv /etc/vsftpd.conf /etc/vsftpd.conf.bak
cp ./vsftpd.conf /etc/vsftpd.conf
systemctl restart vsftpd

# add port to ftp
firewall-cmd --add-port=21/tcp --permanent
firewall-cmd --add-port=30000-30100/tcp --permanent
firewall-cmd --reload

# Instalar apache2
zypper install -y apache2
systemctl start apache2
systemctl enable apache2

# Instalar php7
zypper install -y php7 php7-cli apache2-mod_php7

# enable php modules 
a2enmod php7

# copy php code to apache htdocs
cp ./index.php /srv/www/htdocs/index.php

# open firewall ports to apache2
firewall-cmd --permanent --add-service=http
firewall-cmd --permanent --add-service=https
firewall-cmd --reload

# enable apache2 service
systemctl restart apache2

# install mysql
zypper install -y mariadb
systemctl start mysql
systemctl enable mysql
zypper install -y php7-mysql
# init database
mysql -u root < mysqlInit.sql

# install db manager
zypper install -y adminer
cp ./adminer.conf /etc/apache2/conf.d/adminer.conf

# add php sites
cp ./conn.php /srv/www/htdocs/conn.php
cp ./add_task.php /srv/www/htdocs/add_task.php
cp ./delete_task.php /srv/www/htdocs/delete_task.php
cp ./todolist.php /srv/www/htdocs/todolist.php

systemctl restart apache2
