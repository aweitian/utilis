# 常用函数操作
## 安装组件
使用 composer 命令进行安装或下载源代码使用。
> composer require aweitian/utilis
>


## 常用数组操作
```angular2html
$data = ['a' => 'aaa','b' => 'bbb','cc' => 'ab']
```

```angular2html
Arr::get($data,'a','cc') // ['a'=>'aaa','cc'=>'ab']
Arr::g($data,['a','cc']) // ['a'=>'aaa','cc'=>'ab']
```

```angular2html
Arr::except($data,'a','cc') //['b'=>'bbb']
Arr::e($data,['a','cc']) //['b'=>'bbb']
```


```angular2html
Arr::filter($data,'aaa','ab') //['bbb']
Arr::f($data,['aaa','ab']) //['bbb']
```