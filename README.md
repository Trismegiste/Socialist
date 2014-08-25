# Socialist [![Build Status](https://travis-ci.org/Trismegiste/Socialist.svg?branch=master)](https://travis-ci.org/Trismegiste/Socialist)
Core library for social networking

## What
This is a library for any facebook/twitter-like social network with a persistance in MongoDB.

Features :

* 'Like/+1' feature on users and contents like facebook/google+
* follower on users like twitter
* stack of commentary on each content
* content = { text , status , commentary , photo, video , event }
* fully extensible
* KISS
* SOLID

## Model
![Model](https://github.com/Trismegiste/Socialist/tree/master/doc/model.svg)

## How 
It relies on [Yuurei][1] for persistence. It is fully documented with phpDocumentor and
fully tested (including functional tests with [dokudoki][2] external persistence layer)


[1]: https://github.com/Trismegiste/Yuurei
[2]: https://github.com/Trismegiste/DokudokiBundle
