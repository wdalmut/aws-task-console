# AWS task console

Just download the [phar archive](http://example.walterdalmut.com/aws-console.phar).

## Start a list of ec2 instances

```
aws-console.phar ec2:start i-xxxxxx i-yyyyyy i-zzzzzz
```

## Stop a list of ec2 instances

```
aws-console.phar ec2:stop i-xxxxxx i-yyyyyy i-zzzzzz
```

## Install by yourself

```shell
git clone https://github.com/corley/aws-task-console.git
cd aws-task-console

curl -s http://getcomposer.org/installer | php
php composer.phar install

php aws.php ec2:start ...
```

