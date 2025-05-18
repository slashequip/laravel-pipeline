<?php

use Slashequip\LaravelPipeline\Exceptions\NoPipesSetException;
use Slashequip\LaravelPipeline\Exceptions\NoTransportSetException;
use Slashequip\LaravelPipeline\Pipeline;
use Slashequip\LaravelPipeline\Pipes\AnonymousPipe;
use Slashequip\LaravelPipeline\Pipes\HookablePipe;
use Slashequip\LaravelPipeline\HookRegistry;
use Slashequip\LaravelPipeline\Tests\Exceptions\QuietTestException;
use Slashequip\LaravelPipeline\Tests\Exceptions\RegularTestException;
use Slashequip\LaravelPipeline\Tests\Exceptions\TeardownTestException;
use Slashequip\LaravelPipeline\Tests\Stubs\TestPatchPipe;
use Slashequip\LaravelPipeline\Tests\Stubs\TestSetAgePipe;
use Slashequip\LaravelPipeline\Tests\Stubs\TestSetIdPipe;
use Slashequip\LaravelPipeline\Tests\Stubs\TestSetNamePipe;
use Slashequip\LaravelPipeline\Tests\Stubs\TestThrowsExceptionPipe;
use Slashequip\LaravelPipeline\Tests\Stubs\TestThrowsQuietExceptionPipe;
use Slashequip\LaravelPipeline\Tests\Stubs\TestThrowsTeardownExceptionPipe;
use Slashequip\LaravelPipeline\Tests\Stubs\TestTransport;

it('will throw an exception when running the pipeline with no transport set', function () {
    // Given we have a pipeline
    $pipeline = Pipeline::make();

    // When run the pipeline
    $pipeline->deliver();

    // Then we get an exception
})->expectException(NoTransportSetException::class);

it('will throw an exception when running the pipeline no pipes set', function () {
    // Given we have a pipeline
    $pipeline = Pipeline::make();

    // And we have set a transport
    $pipeline->send(TestTransport::make());

    // When run the pipeline
    $pipeline->deliver();

    // Then we get an exception
})->expectException(NoPipesSetException::class);

it('will throw an exception when running the pipeline with an empty number of pipes', function () {
    // Given we have a pipeline
    $pipeline = Pipeline::make();

    // And we have set a transport
    $pipeline->send(TestTransport::make());

    // And we have set empty pipes
    $pipeline->through(...[]);

    // When run the pipeline
    $pipeline->deliver();

    // Then we get an exception
})->expectException(NoPipesSetException::class);

it('will throw an exception when running the pipeline if the pipe throws an exception', function () {
    // Given we have a pipeline
    $pipeline = Pipeline::make();

    // And we have set a transport
    $pipeline->send(TestTransport::make());

    // And we have a pipe that will throw an error
    $pipeline->through(TestThrowsExceptionPipe::make());

    // When run the pipeline
    $pipeline->deliver();

    // Then we get an exception
})->expectException(RegularTestException::class);

it('will not throw an exception when running the pipeline if the pipe handles quietly', function () {
    // Given we have a pipeline
    $pipeline = Pipeline::make();

    // And we have set a transport
    $pipeline->send(TestTransport::make());

    // And we have a pipe that will throw an error
    $pipeline->through(TestThrowsQuietExceptionPipe::make());

    // When run the pipeline
    /** @var TestTransport $transport */
    $transport = $pipeline->deliver();

    // Then we have set the data without throwing an exception
    $this->assertSame(QuietTestException::class, $transport->get('exception'));
});

it('will perform teardown before exception is thrown within pipe', function () {
    // Given we have a pipeline
    $pipeline = Pipeline::make();

    // And we have set a transport
    $transport = TestTransport::make();
    $pipeline->send($transport);

    // And we have a pipe that will throw an error
    $pipeline->through(TestThrowsTeardownExceptionPipe::make());

    // When run the pipeline
    try {
        $pipeline->deliver();
    } catch (TeardownTestException $e) {
        $this->assertTrue(true);
    }

    // Then we have set the data without throwing an exception
    $this->assertTrue($transport->get('teardown'));
    $this->assertSame(TeardownTestException::class, $transport->get('exception'));
});

it('will run a pipe', function () {
    // Given we have a pipeline
    $pipeline = Pipeline::make();

    // And we have set a transport
    $pipeline->send(TestTransport::make());

    // And we have set empty pipes
    $pipeline->through(TestSetIdPipe::make());

    // When we run the pipeline
    /** @var TestTransport $transport */
    $transport = $pipeline->deliver();

    // Then we have set the data as expected
    $this->assertSame(123, $transport->get('id'));
});

it('will run multiple pipes', function () {
    // Given we have a pipeline
    $pipeline = Pipeline::make();

    // And we have set a transport
    $pipeline->send(TestTransport::make());

    // And we have set empty pipes
    $pipeline->through(TestSetIdPipe::make(), TestSetNamePipe::make());

    // When we run the pipeline
    /** @var TestTransport $transport */
    $transport = $pipeline->deliver();

    // Then we have set the data as expected
    $this->assertSame(123, $transport->get('id'));
    $this->assertSame("Jane Doe", $transport->get('name'));
});

it('will run patch pipes', function () {
    // Given we have a pipeline
    $pipeline = Pipeline::make();

    // And we have set a transport
    $pipeline->send(TestTransport::make());

    // And we have set empty pipes
    $pipeline->through(
        TestSetIdPipe::make(),
        TestPatchPipe::make(),
        TestSetNamePipe::make()
    );

    // When we run the pipeline
    /** @var TestTransport $transport */
    $transport = $pipeline->deliver();

    // Then we have set the data as expected
    $this->assertSame(123, $transport->get('id'));
    $this->assertSame(69, $transport->get('age'));
    $this->assertSame("Jane Doe", $transport->get('name'));
});

it('will run an anonymous pipe', function () {
    // Given we have a pipeline
    $pipeline = Pipeline::make();

    // And a variable to test
    $touched = new stdClass();
    $touched->status = false;

    // And we have set a transport
    $pipeline->send(TestTransport::make());

    // And we have set empty pipes
    $pipeline->through(AnonymousPipe::make(fn () => $touched->status = true));

    // When we run the pipeline
    $pipeline->deliver();

    // Then we have set the data as expected
    $this->assertTrue($touched->status);
});

it('will execute a callback via deliverAnd and return the transport', function () {
    // Given we have a pipeline
    $pipeline = Pipeline::make();

    // And we have set a transport
    $transport = TestTransport::make();
    $pipeline->send($transport);

    // And we have set a simple pipe
    $pipeline->through(TestSetIdPipe::make());

    $callbackCalled = false;

    // When we run deliverAnd
    $result = $pipeline->deliverAnd(function ($passed) use (&$callbackCalled, $transport) {
        $callbackCalled = true;
        \PHPUnit\Framework\Assert::assertSame($transport, $passed);
    });

    // Then the callback was invoked and the transport returned
    expect($callbackCalled)->toBeTrue();
    expect($result)->toBe($transport);
});

it('will run hookable pipes', function () {
    HookRegistry::register('user.pipeline', TestSetAgePipe::make());

    $pipeline = Pipeline::make();
    $pipeline->send(TestTransport::make());
    $pipeline->through(
        TestSetIdPipe::make(),
        HookablePipe::withHook('user.pipeline'),
        TestSetNamePipe::make(),
    );

    /** @var TestTransport $transport */
    $transport = $pipeline->deliver();

    expect($transport->get('id'))->toBe(123);
    expect($transport->get('age'))->toBe(69);
    expect($transport->get('name'))->toBe('Jane Doe');
});
