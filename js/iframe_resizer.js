/**
 * Listen for a window post message to resize an embedded iframe
 * Needs to be an json stringified object that identifies the id of
 * the element to resize like this:

   parent.postMessage(JSON.stringify({
      subject: "lti.frameResize",
      height: default_height,
      iframe_resize_id: "lumen_assessment_1"
  }), "*");

 * The element_id needed is passed as a query parameter `iframe_resize_id`
 */
window.addEventListener('message', function (e) {
    try {
        var message = JSON.parse(e.data);

        switch (message.subject) {
            case 'lti.frameResize':
                var $iframe = jQuery('#' + message.iframe_resize_id);
                if ($iframe.length == 1 && $iframe.hasClass('resizable')) {
                    var height = message.height;
                    if (height >= 5000) height = 5000;
                    if (height <= 0) height = 1;

                    // add a little extra padding to help ensure scroll bar
                    // doesn't appear.
                    height = height + 10;

                    $iframe.css('height', height + 'px');
                    sendIframeResize();
                }
                break;
        }
    } catch (err) {
        (console.error || console.log)('invalid message received from ', e.origin);
    }
});

/**
 * Sends a Window.postMessage to resize the iframe
 * (Only works in Canvas for now)
 */
function sendIframeResize() {
  if(self != top) {
    // get rid of double iframe scrollbars
    var default_height = Math.max(
        document.body.scrollHeight, document.body.offsetHeight,
        document.documentElement.clientHeight, document.documentElement.scrollHeight,
        document.documentElement.offsetHeight);

    parent.postMessage(JSON.stringify({
        subject: "lti.frameResize",
        height: default_height + 25
    }), "*");
  }
}
