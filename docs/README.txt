README
======

由于Zend Framework框架比较大，所以没有把Zend库打包到发布的版本中。
部署项目时需要手动拷贝Zend 1.1版到APPLICATION_PATH/library目录
导入APPLICATION_PATH/doc/dwz_zf.sql

This directory should be used to place project specfic documentation including
but not limited to project notes, generated API/phpdoc documentation, or 
manual files generated or hand written.  Ideally, this directory would remain
in your development environment only and should not be deployed with your
application to it's final production location.


Setting Up Your VHOST
=====================

The following is a sample VHOST you might want to consider for your project.

<VirtualHost *:80>
   DocumentRoot "D:/workspace/PHP/dwz_zf/public"
   ServerName localhost

   # This should be omitted in the production environment
   SetEnv APPLICATION_ENV development
    
   <Directory "D:/workspace/PHP/dwz_zf/public">
       Options Indexes MultiViews FollowSymLinks
       AllowOverride All
       Order allow,deny
       Allow from all
   </Directory>
    
</VirtualHost>
