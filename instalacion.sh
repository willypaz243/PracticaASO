# Instalar apache2
zypper install apache2
# Instalar php7
zypper install php7 apache2-mod_php7
# enable php modules 
a2enmod php7
# copy php code to apache htdocs
cp ./index.php /srv/www/htdocs/
# enable apache2 service
service apache2 stop
service apache2 start

