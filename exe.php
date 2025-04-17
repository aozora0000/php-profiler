<?php
foreach (glob(__DIR__ . '/src/*.php') as $file) {
    require_once $file;
}
$instance = new Sample;
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
runIt(function() use ($instance) {
    return $instance->do();
}, 'new class with use');
runIt(function () {
    return Sample::do_static();
}, 'static method');

runIt(function () {
    return call_user_func('sample');
}, 'call user func string');

runIt(function () {
    return call_user_func(fn() => sample());
}, 'call user closure');
runIt(function () {
    return call_user_func([new Sample, 'do']);
}, 'call user new class');
runIt(function() use ($instance) {
    return call_user_func([$instance, 'do']);
}, 'call user new class with use');
runIt(function () {
    return call_user_func([Sample::class, 'do_static']);
}, 'call user static method');
runIt(function () {
    return call_user_func(Sample::class . '::do_static');
}, 'call user static method string');
