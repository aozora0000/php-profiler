<?php
foreach (glob(__DIR__ . '/src/*.php') as $file) {
    require_once $file;
}

printf("=== PHP %s\n", phpversion());

runIt(function() {
    return sample();
}, 'function');
runIt(function() {
    return fn() => sample();
}, 'closure');
runIt(function() {
    $sample = new Sample();
    return $sample->do();
}, 'new class');
runIt(function () {
    return call_user_func('sample');
}, 'call func');
runIt(function () {
    return call_user_func([new Sample, 'do']);
}, 'call method');
runIt(function () {
    return call_user_func([Sample::class, 'do_static']);
}, 'call static method');
runIt(function () {
    return Sample::do_static();
}, 'call static method direct');