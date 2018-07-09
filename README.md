# WEBRTC_PHP_MIRROR_SERVER

The concept is simple:
    Create a Webrtc referer that is not dependent on any one server, and minimal server-side programming, in PHP.
    
   Escape the Node nightmere.... sorry all you Node developers, but Node is not a stable platform, and the learning-investment far exceeds the hack-risk and version instability and repository obscurity that relegates Node as an "accident prone" nightmere waiting to happen. 
    
   #What it does:
      1 - X-client makes an offer and sends ICE candidates to the mirror.
      2 - Y-client, an anonymous client, sees the existence of the offer on the mirror, and answers it to the mirror.
      3 - X-client is watching the mirror from the browser, so as soon as the mirror contents change, the answer is loaded into setRemoteDescription on the clients page.
      4 - a connection is made....
      5 - the mirror expires in a matter of seconds, and it is not saved on the server. The connection between X and Y is direct P2P WebRTC. 
     
  * Users must have browsers that support WebRTC.   
  * Users must instantiate their connections using standard protocols from commonly configured networks; and not from behind complicated corporate security firewalls or from networks with novel methods of encryption.
