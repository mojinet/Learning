/***************************************************/
// ** Asynchronous
// all asynchronous call placed in "event loop", who is a call stack
/***************************************************/

// Time method
// setTimeOut(function, time in ms)
// clearTimeout() for cancel before execute
// setInterval(function, time in ms) executed all Xms, use clearInterval() for stop loop
// setImmediate(function) placed function in high of call stack

// Callbacks : prefer use promise
// The callback is a method who is call after un asynchronous execution like with setTimeout() for example :
setTimeout(function() {
    console.log("I'm here!") // extecuted after 5000ms
}, 5000);

// Is best to prevent error like :
fs.readFile(filePath, function(err, data) {
    if (err) {
        throw err;
    }
    // Do something with data
});

// Promises
// Promise is an object who is returned immediatly after call, but .then() is executed when is finish and .catch() in case of error
returnAPromiseWithNumber2()
    .then(function(data) { // Data is 2
        return data + 1;
    })
    .then(function(data) { // Data is 3
        throw new Error('error');
    })
    .then(function(data) {
        // Not executed
    })
    .catch(function(err) {
        return 5;
    })
    .then(function(data) { // Data is 5
        // Do something
    });

// multiple-promise in parallel
Promise.all([get(url1), get(url2)])
    .then(function(results) { // executed when all promise is solved
        return Promise.all([results, post(url3)]];
    })
    .then(function(allResults) {
        // We are done here !
    });

// Async/await
async function fonctionAsynchrone1() {/* code asynchronous */}
async function fonctionAsynchrone2() {/* code asynchronous */}

async function fonctionAsynchrone3() {
    const value1 = await fonctionAsynchrone1();
    const value2 = await fonctionAsynchrone2();
    return value1 + value2;
}

// parallele
async function requests() {
    var getResults = await Promise.all([get(url1), get(url2)]);
    var postResult = await post(url3);
    return [getResults, postResult];
}

requests().then(function(allResults) {
    // We are done here !
});