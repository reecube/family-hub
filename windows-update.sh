#!/bin/bash

php bin/console cache:clear

taskkill /F /IM php-cgi.exe /T
