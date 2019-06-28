Apache2 example config
-------------------

```
<VirtualHost *:80>
    ServerName api.loc

    ErrorLog /var/log/apache2/api.loc.error.log
    CustomLog /var/log/apache2/api.loc.access.log combined
    
    AddDefaultCharset UTF-8

    Options FollowSymLinks
    DirectoryIndex index.php index.html
    RewriteEngine on

    RewriteRule /\. - [L,F]

    DocumentRoot /var/www/api.loc/frontend/web
    <Directory /var/www/api.loc/frontend/web>
        AllowOverride none
        <IfVersion < 2.4>
          Order Allow,Deny
          Allow from all
        </IfVersion>
        <IfVersion >= 2.4>
          Require all granted
        </IfVersion>

        # if a directory or a file exists, use the request directly
        RewriteCond %{REQUEST_FILENAME} !-f
        RewriteCond %{REQUEST_FILENAME} !-d
        # otherwise forward the request to index.php
        RewriteRule ^ index.php [L]
    </Directory>

    # redirect to the URL without a trailing slash (uncomment if necessary)
    #RewriteRule ^/admin/$ /admin [L,R=301]

    Alias /backend /var/www/api.loc/backend/web
    # prevent the directory redirect to the URL with a trailing slash
    RewriteRule ^/backend$ /backend/ [L,PT]
    <Directory /var/www/api.loc/backend/web>
        AllowOverride none
        <IfVersion < 2.4>
            Order Allow,Deny
            Allow from all
        </IfVersion>
        <IfVersion >= 2.4>
            Require all granted
        </IfVersion>

        # if a directory or a file exists, use the request directly
        RewriteCond %{REQUEST_FILENAME} !-f
        RewriteCond %{REQUEST_FILENAME} !-d
        # otherwise forward the request to index.php
        RewriteRule ^ index.php [L]
    </Directory>
    
    Alias /api /var/www/api.loc/api/web
    # prevent the directory redirect to the URL with a trailing slash
    RewriteRule ^/api$ /api/ [L,PT]
    <Directory /var/www/api.loc/api/web>
        AllowOverride none
        <IfVersion < 2.4>
            Order Allow,Deny
            Allow from all
        </IfVersion>
        <IfVersion >= 2.4>
            Require all granted
        </IfVersion>

        # if a directory or a file exists, use the request directly
        RewriteCond %{REQUEST_FILENAME} !-f
        RewriteCond %{REQUEST_FILENAME} !-d
        # otherwise forward the request to index.php
        RewriteRule ^ index.php [L]
    </Directory>

</VirtualHost>

```
