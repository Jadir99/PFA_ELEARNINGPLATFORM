<!DOCTYPE html>
<html lang="en">

<head>
    <title>AZUL AI</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta charset="utf-8">
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="AZUL AI" />
    <meta property="og:description" content="Discover Morocco’s rich culture and vibrant heritage effortlessly with AZUL AI, your smart guide to the best local experiences." />
    <meta property="og:url" content="https://azulaimaroc.com/" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="{{ asset('static/assets/images/azul.png') }}" />
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('public/images/azul.png') }}">

    <!-- CSS ============================================ -->
    <link rel="stylesheet" href="{{ asset('public/css/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/plugins/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/plugins/animation.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/plugins/feature.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/plugins/magnify.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/plugins/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/plugins/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/plugins/lightbox.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/plugins/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/plugins/prism.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/style copy.css') }}">

</head>

<body>
    <main class="page-wrapper rbt-dashboard-page">
        <div class="rbt-panel-wrapper">

            <header class="rbt-dashboard-header rainbow-header header-default header-left-align rbt-fluid-header">
                <div class="container-fluid position-relative">
                    <div class="row align-items-center">
                        <div class="col-lg-2 col-md-6 col-7">
                            <div class="header-left d-flex">
                                <div class="expand-btn-grp">
                                    <button class="bg-solid-primary popup-dashboardleft-btn"><i class="feather-sidebar left"></i></button>
                                </div>
                                <div class="logo">
                                    <a href="{{ url('/') }}">
                                        <img class="logo-light" src="{{ asset('static/assets/images/AZUL-AI-white.png') }}" style="width: 130px; height: auto;" alt="Corporate Logo">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-10 col-md-6 col-5">
                            <div class="header-right">
                                <nav class="mainmenu-nav d-none d-lg-block text-center">
                                    <ul class="mainmenu">
                                        <li><a href="{{ url('/') }}">Home @php
    echo currentUserId();
@endphp</a></li>
                                    </ul>
                                </nav>

                                <div class="expand-btn-grp @@display-class">
                                    <button class="bg-solid-primary popup-dashboardright-btn"><i class="feather-sidebar right"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="rbt-left-panel popup-dashboardleft-section mt-5">
                    <img src="{{ asset('static/assets/images/maroc.png') }}" alt="Morocco">
                </div>
                <div class="rbt-right-side-panel popup-dashboardright-section">
                    <img src="{{ asset('static/assets/images/bessma.png') }}" alt="Bessma">
                </div>
            </header>

            <!-- Main content -->
            <div class="rbt-main-content">
                <div class="rbt-daynamic-page-content">

                    <!-- Dashboard Center Content -->
                    <div class="rbt-dashboard-content">
                        <div class="content-page">
                            <div class="chat-box-list pt--30" id="chatContainer">
                                <!-- this is for the data (dynamic data) -->
                            </div>
                        </div>

                        <div class="rbt-static-bar">
                            <form class="new-chat-form border-gradient" onsubmit="return false;">
                                <textarea id="txtarea" rows="1" placeholder="Send a message..."></textarea>
                                <div class="left-icons">
                                    <div title="ChatenAI" class="form-icon icon-gpt">
                                        <i class="feather-aperture"></i>
                                    </div>
                                </div>
                                <div class="right-icons">
                                    <button class="form-icon icon-send" id="sendButton" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Send message">
                                        <i class="feather-send"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        function initializeChat() {
          // Get references to the HTML elements
          const chatBox = document.getElementById('chatContainer');
          const userInput = document.getElementById('txtarea');
          const sendButton = document.getElementById('sendButton');
          let welcomeMessageIndex = 0;
        //   const userId = @json(currentUserId());
          const user_id = @json(651651);
          const welcomeMessages = [
            "Hello, how can I help you?"
          ];
      
          // Function to add a message to the chat box
          function addMessage(content, sender, isEditable = false, imgSrc = '',speechClass) {
            const messageDiv = document.createElement('div');
            messageDiv.className = `chat-box ai-speech bg-flashlight ${speechClass}`;
            messageDiv.innerHTML = `
            
            <div class="inner top-flashlight leftside light-xl">
                <div class="chat-section">
                    <div class="author">
                    <img style="width: 50px; height: auto;"  src="${imgSrc}" alt="${sender}">
                    </div>
                    <div class="chat-content">
                    <h6 class="title">${sender}</h6>
                    <p class="mb--20 ${isEditable ? 'editable' : ''}" ${isEditable ? 'contenteditable="true"' : ''}>${content}</p>
                    </div>
                </div>
            </div>
            `;
            chatBox.appendChild(messageDiv);
            chatBox.scrollTop = chatBox.scrollHeight; // Auto-scroll to the bottom
          }
      
          // Add a loading message
          function showLoadingMessage() {
            const loadingMessage = document.createElement('div');
            loadingMessage.classList.add('chat-section', 'generate-section');
            loadingMessage.innerHTML = `
              <div class="author">
                <img src="https://www.icegif.com/wp-content/uploads/2022/12/icegif-566.gif" style="width: 50px; height: auto;" alt="Loader Images">
              </div>
              <div class="chat-content">
                <h6 class="title color-text-off mb--0">Generating answers for you…</h6>
              </div>
            `;
            chatBox.appendChild(loadingMessage);
          }
      
          // Remove the loading message
          function removeLoadingMessage() {
            const previousLoadingMessage = document.querySelector('.generate-section');
            if (previousLoadingMessage) {
              previousLoadingMessage.remove();
            }
          }
      
          // Send user input to the server
          sendButton.addEventListener('click', () => {
            const message = userInput.value.trim();
            if (message === '') return;
      
            // Display user message in the chat box
            addMessage(message, 'user', true, '{{ asset('static/assets/images/avatar-homme.png') }}','user-speech');
      
            // Clear the input field
            userInput.value = '';
      
            // Show loading message
            showLoadingMessage();
            // Send the user message to Flask backend using fetch (AJAX)
            fetch('http://127.0.0.1:5001/chat', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json',
              },
              body: JSON.stringify({ message,user_id })
            })
            .then(response => response.json())
            .then(data => {
              removeLoadingMessage();  // Remove loading message
              addMessage(data.response, 'AZUL AI', false, '{{ asset('static/assets/images/azul-icon.png') }}', 'ai-speech'); // Add bot response
            })
            .catch(error => {
              console.error('Error:', error);
              removeLoadingMessage(); // Remove loading message
              addMessage('Sorry, something went wrong.', 'AZUL AI', false, '{{ asset('static/assets/images/azul-icon.png') }}');
            });
          });
      
          // Allow pressing Enter to send the message
          userInput.addEventListener('keydown', (event) => {
            if (event.key === 'Enter' && !event.shiftKey) {
              event.preventDefault();
              sendButton.click();
            }
          });
      
          // Display the welcome message when the page loads
          addMessage(welcomeMessages[welcomeMessageIndex], 'AZUL AI', false, '{{ asset('static/assets/images/azul-icon.png') }}', 'ai-speech');
        }
      
        window.onload = initializeChat;
    </script>
    <script src="{{ asset('public/js/vendor/modernizr-3.6.0.min.js') }}"></script>
    <script src="{{ asset('public/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('public/js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('public/js/plugins/slick.js') }}"></script>
    <script src="{{ asset('public/js/plugins/magnify.min.js') }}"></script>
    <script src="{{ asset('public/js/plugins/waypoints.js') }}"></script>
    <script src="{{ asset('public/js/plugins/counterup.min.js') }}"></script>
    <script src="{{ asset('public/js/plugins/lightbox.js') }}"></script>
    <script src="{{ asset('public/js/plugins/prism.js') }}"></script>
    <script src="{{ asset('public/js/plugins/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('public/js/main.js') }}"></script>
</body>

</html>
