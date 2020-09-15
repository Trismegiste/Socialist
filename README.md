# Socialist [![Build Status](https://travis-ci.org/Trismegiste/Socialist.svg?branch=master)](https://travis-ci.org/Trismegiste/Socialist)
Core library for social networking

## What
This is a library for any facebook/twitter-like social network with a persistance in MongoDB.

Features :

* 'Like/+1' feature on users and contents like facebook/google+
* follower on users like twitter
* stack of commentary on each content
* abuse/spam report
* content = { text , status , commentary , photo, video , re-tweet }
* fully extensible
* KISS
* SOLID

## Model
See the last class hierarchy generated with [phpDocumentor][3].

Here is a quick overview :
![Model](/doc/model.png)

## How 
It relies on [trismegiste/toolbox][1] for persistence. It is fully documented with phpDocumentor and
fully tested (including functional tests with trismegiste/toolbox)


[1]: https://github.com/Trismegiste/toolbox
[3]: http://phpdoc.org/docs/latest/getting-started/installing.html#phar
