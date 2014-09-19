# AWS task console

```shell
git clone https://github.com/corley/aws-task-console.git
cd aws-task-console

curl -s http://getcomposer.org/installer | php
php composer.phar install
```

## Start a list of ec2 instances

```
php aws.php ec2:start i-xxxxxx i-yyyyyy i-zzzzzz
```

## Stop a list of ec2 instances

```
php aws.php ec2:stop i-xxxxxx i-yyyyyy i-zzzzzz
```

