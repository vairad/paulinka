function sleep(ms) {
  return new Promise(resolve => setTimeout(resolve, ms));
}

async function enableWithLatency(jQuery) {
	console.log("Start late latency")
	await sleep(6000);
	console.log("Wake up late latency")
    $('.late-enable').prop('disabled', false);
	console.log("Enable performed")
}
 
enableWithLatency();
