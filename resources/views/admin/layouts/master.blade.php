<!doctype html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <!-- Basic Page Needs
================================================== -->
    <title>Gotem Dashboard</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSS
================================================== -->
    <link rel="stylesheet" href="{{asset('backstyling/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('backstyling/css/colors/blue.css')}}">
    <link rel="stylesheet" href="{{asset('backstyling/css/datatable.css')}}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.0.0/css/boxicons.min.css">

</head>

<body class="gray">
<style>
@import url("https://fonts.googleapis.com/css?family=Open+Sans:300,600");
@import url("https://fonts.googleapis.com/css?family=Open+Sans:300,600");
.chatbot {
  display: none;
  position: fixed;
  z-index: 1000 !important;
  top: 0;
  bottom: 50px;
  width: 100%;
  box-shadow: 0 -6px 99px -17px rgba(0, 0, 0, 0.68);
}
@media screen and (min-width: 640px) {
  .chatbot {
    max-width: 420px;
    right: 50px;
    top: auto;
  }
}
.chatbot.chatbot--closed {
  top: auto;
  width: 100%;
}

.chatbot__header {
  color: #fff;
  display: flex;
  align-items: center;
  justify-content: space-between;
  background-color: #d20c11;
  height: 54px;
  padding: 0 20px;
  width: 100%;
  cursor: pointer;
  transition: background-color 0.2s ease;
}
.chatbot__header:hover {
  background-color: #f21f24;
}
.chatbot__header p {
  margin-right: 20px;
}

.chatbot__close-button {
  fill: #fff;
}
.chatbot__close-button.icon-speech {
  width: 20px;
  display: none;
}
.chatbot--closed .chatbot__close-button.icon-speech {
  display: block;
}
.chatbot__close-button.icon-close {
  width: 14px;
}
.chatbot--closed .chatbot__close-button.icon-close {
  display: none;
}

.chatbot__message-window {
  height: calc(100% - (54px + 60px));
  padding: 40px 20px 20px;
  background-color: #fff;
  overflow-x: none;
  overflow-y: auto;
}
@media screen and (min-width: 640px) {
  .chatbot__message-window {
    height: 380px;
  }
}
.chatbot__message-window::-webkit-scrollbar {
  display: none;
}
.chatbot--closed .chatbot__message-window {
  display: none;
}

.chatbot__messages {
  padding: 0;
  margin: 0;
  list-style: none;
  display: flex;
  flex-direction: column;
  width: auto;
}
.chatbot__messages li {
  margin-bottom: 20px;
}
.chatbot__messages li.is-ai {
  display: inline-flex;
  align-items: flex-start;
}
.chatbot__messages li.is-user {
  text-align: right;
  display: inline-flex;
  align-self: flex-end;
}
.chatbot__messages li .is-ai__profile-picture {
  margin-right: 8px;
}
.chatbot__messages li .is-ai__profile-picture .icon-avatar {
  width: 40px;
  height: 40px;
  padding-top: 6px;
}

.chatbot__message {
  display: inline-block;
  padding: 12px 20px;
  word-break: break-word;
  margin: 0;
  border-radius: 6px;
  letter-spacing: -0.01em;
  line-height: 1.45;
  overflow: hidden;
}
.is-ai .chatbot__message {
  background-color: #f0f0f0;
  margin-right: 30px;
}
.is-user .chatbot__message {
  background-color: #d20c11;
  margin-left: 30px;
}
.chatbot__message a {
  color: #d20c11;
  word-break: break-all;
  display: inline-block;
}
.chatbot__message p:first-child {
  margin-top: 0;
}
.chatbot__message p:last-child {
  margin-bottom: 0;
}
.chatbot__message button {
  background-color: #fff;
  font-weight: 300;
  border: 2px solid #d20c11;
  border-radius: 50px;
  padding: 8px 20px;
  margin: -8px 10px 18px 0;
  transition: background-color 0.2s ease;
  cursor: pointer;
}
.chatbot__message button:hover {
  background-color: #f2f2f2;
}
.chatbot__message button:focus {
  outline: none;
}
.chatbot__message img {
  max-width: 100%;
}

.animation:last-child {
  -webkit-animation: fadein .25s;
          animation: fadein .25s;
  -webkit-animation-timing-function: all 200ms cubic-bezier(0.55, 0.055, 0.675, 0.19);
          animation-timing-function: all 200ms cubic-bezier(0.55, 0.055, 0.675, 0.19);
}

.chatbot__arrow {
  width: 0;
  height: 0;
  margin-top: 18px;
}

.chatbot__arrow--right {
  border-top: 6px solid transparent;
  border-bottom: 6px solid transparent;
  border-left: 6px solid #d20c11;
}

.chatbot__arrow--left {
  border-top: 6px solid transparent;
  border-bottom: 6px solid transparent;
  border-right: 6px solid #f0f0f0;
}

.chatbot__entry {
  display: flex;
  align-items: center;
  justify-content: space-between;
  height: 60px;
  padding: 0 20px;
  border-top: 1px solid #d20c11;
  background-color: #fff;
}
.chatbot--closed .chatbot__entry {
  display: none;
}

.chatbot__input:focus {
  outline: none;
}
.chatbot__input::-webkit-input-placeholder {
  color: #d20c11;
}
.chatbot__input::-moz-placeholder {
  color: #d20c11;
}
.chatbot__input::-ms-input-placeholder {
  color: #d20c11;
}
.chatbot__input::-moz-placeholder {
  color: #d20c11;
}

.chatbot__submit {
  fill: #d20c11;
  height: 22px;
  width: 22px;
  transition: fill 0.2s ease;
  cursor: pointer;
}
.chatbot__submit:hover {
  fill: #720609;
}

.u-text-highlight {
  color: #d20c11;
}

.chatbot {
  display: none;
  position: fixed;
  top: 0;
  bottom: 50px;
  width: 100%;
  box-shadow: 0 -6px 99px -17px rgba(0, 0, 0, 0.68);
}
@media screen and (min-width: 640px) {
  .chatbot {
    max-width: 420px;
    right: 50px;
    top: auto;
  }
}
.chatbot.chatbot--closed {
  top: auto;
  width: 100%;
}

.chatbot__header {
  color: #fff;
  display: flex;
  align-items: center;
  justify-content: space-between;
  background-color: #bf2024;
  height: 54px;
  padding: 0 20px;
  width: 100%;
  cursor: pointer;
  transition: background-color 0.2s ease;
}
.chatbot__header:hover {
  background-color: #dd3539;
}
.chatbot__header p {
  margin-right: 20px;
}

.chatbot__close-button {
  fill: #fff;
}
.chatbot__close-button.icon-speech {
  width: 20px;
  display: none;
}
.chatbot--closed .chatbot__close-button.icon-speech {
  display: block;
}
.chatbot__close-button.icon-close {
  width: 14px;
}
.chatbot--closed .chatbot__close-button.icon-close {
  display: none;
}

.chatbot__message-window {
  height: calc(100% - (54px + 60px));
  padding: 40px 20px 20px;
  background-color: #fff;
  overflow-x: none;
  overflow-y: auto;
}
@media screen and (min-width: 640px) {
  .chatbot__message-window {
    height: 410px;
  }
}
.chatbot__message-window::-webkit-scrollbar {
  display: none;
}
.chatbot--closed .chatbot__message-window {
  display: none;
}

.chatbot__messages {
  padding: 0;
  margin: 0;
  list-style: none;
  display: flex;
  flex-direction: column;
  width: auto;
}
.chatbot__messages li {
  margin-bottom: 20px;
}
.chatbot__messages li.is-ai {
  display: inline-flex;
  align-items: flex-start;
}
.chatbot__messages li.is-user {
  text-align: right;
  display: inline-flex;
  align-self: flex-end;
}
.chatbot__messages li .is-ai__profile-picture {
  margin-right: 8px;
}
.chatbot__messages li .is-ai__profile-picture .icon-avatar {
  width: 40px;
  height: 40px;
  padding-top: 6px;
}

.chatbot__message {
  display: inline-block;
  padding: 12px 20px;
  word-break: break-word;
  margin: 0;
  border-radius: 6px;
  letter-spacing: -0.01em;
  line-height: 1.45;
  overflow: hidden;
}
.is-ai .chatbot__message {
  background-color: #f0f0f0;
  margin-right: 30px;
}
.is-user .chatbot__message {
  background-color: #fde7e8;
  margin-left: 30px;
  color: #310001;
}
.chatbot__message a {
  color: #bf2024;
  word-break: break-all;
  display: inline-block;
}
.chatbot__message p:first-child {
  margin-top: 0;
}
.chatbot__message p:last-child {
  margin-bottom: 0;
}
.chatbot__message button {
  background-color: #fff;
  font-weight: 300;
  border: 2px solid #bf2024;
  border-radius: 50px;
  padding: 8px 20px;
  margin: -8px 10px 18px 0;
  transition: background-color 0.2s ease;
  cursor: pointer;
}
.chatbot__message button:hover {
  background-color: #f2f2f2;
}
.chatbot__message button:focus {
  outline: none;
}
.chatbot__message img {
  max-width: 100%;
}

.animation:last-child {
  -webkit-animation: fadein 0.25s;
          animation: fadein 0.25s;
  -webkit-animation-timing-function: all 200ms cubic-bezier(0.55, 0.055, 0.675, 0.19);
          animation-timing-function: all 200ms cubic-bezier(0.55, 0.055, 0.675, 0.19);
}

.chatbot__arrow {
  width: 0;
  height: 0;
  margin-top: 18px;
}

.chatbot__arrow--right {
  border-top: 6px solid transparent;
  border-bottom: 6px solid transparent;
  border-left: 6px solid #fde7e8;
}

.chatbot__arrow--left {
  border-top: 6px solid transparent;
  border-bottom: 6px solid transparent;
  border-right: 6px solid #f0f0f0;
}

.chatbot__entry {
  display: flex;
  align-items: center;
  justify-content: space-between;
  height: 60px;
  padding: 0 20px;
  border-top: 1px solid #e6eaee;
  background-color: #fff;
}
.chatbot--closed .chatbot__entry {
  display: none;
}

.chatbot__input {
  height: 100% !important;
  width: 80% !important;
  border: 0 !important;
  box-shadow: 0 1px 4px 0 transparent !important;
  margin: 0 0 0px !important;
}
.chatbot__input:focus {
  outline: none;
}
.chatbot__input::-webkit-input-placeholder {
  color: #7f7f7f;
}
.chatbot__input::-moz-placeholder {
  color: #7f7f7f;
}
.chatbot__input::-ms-input-placeholder {
  color: #7f7f7f;
}
.chatbot__input::-moz-placeholder {
  color: #7f7f7f;
}

.chatbot__submit {
  fill: #bf2024;
  height: 22px;
  width: 22px;
  transition: fill 0.2s ease;
  cursor: pointer;
}
.chatbot__submit:hover {
  fill: #681114;
}

.u-text-highlight {
  color: #fde7e8;
}

.loader {
  margin-bottom: -2px;
  text-align: center;
  opacity: 0.3;
}

.loader__dot {
  display: inline-block;
  vertical-align: middle;
  width: 6px;
  height: 6px;
  margin: 0 1px;
  background: black;
  border-radius: 50px;
  -webkit-animation: loader 0.45s infinite alternate;
          animation: loader 0.45s infinite alternate;
}
.loader__dot:nth-of-type(2) {
  -webkit-animation-delay: 0.15s;
          animation-delay: 0.15s;
}
.loader__dot:nth-of-type(3) {
  -webkit-animation-delay: 0.35s;
          animation-delay: 0.35s;
}

@-webkit-keyframes loader {
  0% {
    -webkit-transform: translateY(0);
            transform: translateY(0);
  }
  100% {
    -webkit-transform: translateY(-5px);
            transform: translateY(-5px);
  }
}

@keyframes loader {
  0% {
    -webkit-transform: translateY(0);
            transform: translateY(0);
  }
  100% {
    -webkit-transform: translateY(-5px);
            transform: translateY(-5px);
  }
}
@-webkit-keyframes fadein {
  from {
    opacity: 0;
    margin-top: 10px;
    margin-bottom: 0;
  }
  to {
    opacity: 1;
    margin-top: 0;
    margin-bottom: 10px;
  }
}
@keyframes fadein {
  from {
    opacity: 0;
    margin-top: 10px;
    margin-bottom: 0;
  }
  to {
    opacity: 1;
    margin-top: 0;
    margin-bottom: 10px;
  }
}


strong {
  font-weight: 600;
}

.intro {
  display: block;
  margin-bottom: 20px;
}

.loader {
  margin-bottom: -2px;
  text-align: center;
  opacity: .3;
}

.loader__dot {
  display: inline-block;
  vertical-align: middle;
  width: 6px;
  height: 6px;
  margin: 0 1px;
  background: black;
  border-radius: 50px;
  -webkit-animation: loader 0.45s infinite alternate;
          animation: loader 0.45s infinite alternate;
}
.loader__dot:nth-of-type(2) {
  -webkit-animation-delay: .15s;
          animation-delay: .15s;
}
.loader__dot:nth-of-type(3) {
  -webkit-animation-delay: .35s;
          animation-delay: .35s;
}

@keyframes loader {
  0% {
    -webkit-transform: translateY(0);
            transform: translateY(0);
  }
  100% {
    -webkit-transform: translateY(-5px);
            transform: translateY(-5px);
  }
}
@keyframes fadein {
  from {
    opacity: 0;
    margin-top: 10px;
    margin-bottom: 0;
  }
  to {
    opacity: 1;
    margin-top: 0;
    margin-bottom: 10px;
  }
}

strong {
  font-weight: 600;
}

.intro {
  display: block;
  margin-bottom: 20px;
}

#chat-circle {
  position: fixed;
  bottom: 50px;
  right: 50px;
  background: #BF2024;
  width: 50px;
  height: 50px;
  border-radius: 50%;
  color: white;
  padding: 12px;
  cursor: pointer;
  box-shadow: 0px 3px 16px 0px rgba(0, 0, 0, 0.6), 0 3px 1px -2px rgba(0, 0, 0, 0.2), 0 1px 5px 0 rgba(0, 0, 0, 0.12);
}


</style>
		<div id="chat-circle" class=" btn-raised" style="z-index: 1000 !important;">
	</div>

<div class="chatbot chatbot--closed ">
  <div class="chatbot__header">
    <p style="margin-top: 15px;"><strong>Group Chat</strong></p>
    <svg class="chatbot__close-button icon-speech" viewBox="0 0 32 32">
      <use xlink:href="#icon-speech" />
    </svg>
    <svg class="chatbot__close-button icon-close" viewBox="0 0 32 32">
      <use xlink:href="#icon-close" />
    </svg>
  </div>
  <div class="chatbot__message-window">
    <ul class="chatbot__messages">
      <li class="is-ai animation">
        <div class="is-ai__profile-picture">
          <svg class="icon-avatar" viewBox="0 0 32 32">
            <use xlink:href="#avatar" />
          </svg>
        </div>
        <span class="chatbot__arrow chatbot__arrow--left"></span>

        <p class='chatbot__message'>Hello</p>
      </li>

      <li class="is-ai animation">
        <div class="is-ai__profile-picture">
          <svg class="icon-avatar" viewBox="0 0 32 32">
            <use xlink:href="#avatar" />
          </svg>
        </div>
        <span class="chatbot__arrow chatbot__arrow--left"></span>
        <p class='chatbot__message'>How are you?</p>
      </li>
      <!-- Message here -->
    </ul>
  </div>
  <div class="chatbot__entry chatbot--closed">
    <input type="text" class="chatbot__input" placeholder="Write a message..." />
    <svg class="chatbot__submit" viewBox="0 0 32 32">
      <use xlink:href="#icon-send" />
    </svg>
  </div>
</div>

<!-- Symbols -->
<svg style="display: none;">
  <!-- Close icon -->
  <symbol id="icon-close" viewBox="0 0 32 32">
    <title>Close</title>
    <path d="M2.624 8.297l2.963-2.963 23.704 23.704-2.963 2.963-23.704-23.704z" />
    <path d="M2.624 29.037l23.704-23.704 2.963 2.963-23.704 23.704-2.963-2.963z" />
  </symbol>

  <!-- Speech icon -->
  <symbol id="icon-speech" viewBox="0 0 32 32">
    <title>Speech</title>
    <path style="fill: #ffffff; fill-rule: evenodd;" d="M21.795 5.333h-11.413c-0.038 0-0.077 0-0.114 0l-0.134 0.011v2.796c0.143-0.006 0.273-0.009 0.385-0.009h11.277c0.070 0 7.074 0.213 7.074 7.695 0 5.179-2.956 7.695-9.036 7.695h-3.792c-0.691 0-1.12 0.526-1.38 1.159l-1.387 3.093-1.625 3.77 0.245 0.453h2.56l2.538-5.678h2.837c7.633 0 11.84-3.727 11.84-10.494 0.001-8.564-7.313-10.492-9.875-10.492z" />
    <path style="fill: #ffffff; fill-rule: evenodd;" d="M10.912 24.259c-0.242-0.442-0.703-0.737-1.234-0.737-0 0-0 0-0 0h-0.56c-0.599-0.011-1.171-0.108-1.71-0.28l0.042 0.012c-1.82-0.559-4.427-2.26-4.427-7.424 0-6.683 5.024-7.597 7.109-7.686v-2.8c-2.042 0.095-9.91 1.067-9.91 10.483 0 4.832 1.961 7.367 3.606 8.64 1.38 1.067 3.109 1.744 4.991 1.843l0.033 0.019 2.805 5.211 1.41-3.273z" />
  </symbol>

  <!-- Send icon -->
  <symbol id="icon-send" viewBox="0 0 23.97 21.9">
    <title>Send</title>
    <path d="M0.31,9.43a0.5,0.5,0,0,0,0,.93l8.3,3.23L23.15,0Z"/>
    <path d="M9,14.6H9V21.4a0.5,0.5,0,0,0,.93.25L13.22,16l6,3.32A0.5,0.5,0,0,0,20,19l4-18.4Z"/>
  </symbol>
  
  <!-- Avatar icon -->
  <symbol id="avatar" width="44.25" height="44" viewBox="0 0 44.25 44">
    <title>Avatar</title>
    <path style="fill: #bf2024; fill-rule: evenodd;" d="M1035.88,1696.25a22,22,0,1,1-22.13,22A22.065,22.065,0,0,1,1035.88,1696.25Z" transform="translate(-1013.75 -1696.25)"/>
    <path style="fill: #fff; fill-rule: evenodd;" d="M1030.18,1725.16h2.35a0.335,0.335,0,0,0,.34-0.33v-5.23h5.94v5.23a0.342,0.342,0,0,0,.34.33h2.36a0.342,0.342,0,0,0,.34-0.33v-12.36a0.34,0.34,0,0,0-.34-0.32h-2.36a0.34,0.34,0,0,0-.34.32v4.51h-5.94v-4.51a0.333,0.333,0,0,0-.34-0.32h-2.35a0.333,0.333,0,0,0-.34.32v12.36a0.335,0.335,0,0,0,.34.33" transform="translate(-1013.75 -1696.25)"/>
  </symbol>
  
</svg>

<script>
	// List icon by Gregor Cresnar from the Noun Project
// Notification icon by Yo! Baba from the Noun Project
// Other icons provided by Freepik.
const accessToken = "2d1ddeaadc20462dba88c9beebbe0a21";
const baseUrl = "https://api.api.ai/api/query?v=20150910";
const sessionId = "1";
const loader = `<span class='loader'><span class='loader__dot'></span><span class='loader__dot'></span><span class='loader__dot'></span></span>`;
const errorMessage = "My apologies, I'm not available at the moment. =^.^=";
const urlPattern = /(\b(https?|ftp):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/gim;
const loadingDelay = 700;
const aiReplyDelay = 1800;

const $document = document;
const $chatbot = $document.querySelector(".chatbot");
const $chatbotMessageWindow = $document.querySelector(
  ".chatbot__message-window"
);
const $chatbotHeader = $document.querySelector(".chatbot__header");
const $chatbotMessages = $document.querySelector(".chatbot__messages");
const $chatbotInput = $document.querySelector(".chatbot__input");
const $chatbotSubmit = $document.querySelector(".chatbot__submit");

document.addEventListener(
  "keypress",
  event => {
    if (event.which == 13) {
      validateMessage();
    }
  },
  false
);

$chatbotHeader.addEventListener(
  "click",
  () => {
    // toggle($chatbot, "chatbot--closed");
    // $chatbotInput.focus();
    var element =                 document.getElementsByClassName("chatbot");
      element[0].style.display = "none";
     document.getElementById("chat-circle").style.display="block";
  },
  false
);

$chatbotSubmit.addEventListener(
  "click",
  () => {
    validateMessage();
  },
  false
);
document.getElementById("chat-circle").addEventListener(
  "click",
  () => {
    var element = document.getElementsByClassName("chatbot");
    element[0].classList.remove("chatbot--closed");
      element[0].style.display = "block";
        $chatbotInput.focus();
    console.log(this);
    document.getElementById("chat-circle").style.display="none";
    
}
);
const toggle = (element, klass) => {
  const classes = element.className.match(/\S+/g) || [],
    index = classes.indexOf(klass);
  index >= 0 ? classes.splice(index, 1) : classes.push(klass);
  element.className = classes.join(" ");
};

const userMessage = content => {
  $chatbotMessages.innerHTML += `<li class='is-user animation'>
      <p class='chatbot__message'>
        ${content}
      </p>
      <span class='chatbot__arrow chatbot__arrow--right'></span>
    </li>`;
};

const aiMessage = (content, isLoading = false, delay = 0) => {
  setTimeout(() => {
    removeLoader();
    $chatbotMessages.innerHTML += `<li 
      class='is-ai animation' 
      id='${isLoading ? "is-loading" : ""}'>
        <div class="is-ai__profile-picture">
          <svg class="icon-avatar" viewBox="0 0 32 32">
            <use xlink:href="#avatar" />
          </svg>
        </div>
        <span class='chatbot__arrow chatbot__arrow--left'></span>
        <div class='chatbot__message'>
          ${content}
        </div>
      </li>`;
    scrollDown();
  }, delay);
};

/*const removeLoader = () => {
  let loadingElem = document.getElementById("is-loading");
  if (loadingElem) {
    $chatbotMessages.removeChild(loadingElem);
  }
};*/

const escapeScript = unsafe => {
  const safeString = unsafe
    .replace(/</g, " ")
    .replace(/>/g, " ")
    .replace(/&/g, " ")
    .replace(/"/g, " ")
    .replace(/\\/, " ")
    .replace(/\s+/g, " ");
  return safeString.trim();
};

const linkify = inputText => {
  return inputText.replace(urlPattern, `<a href='$1' target='_blank'>$1</a>`);
};

const validateMessage = () => {
  const text = $chatbotInput.value;
  const safeText = text ? escapeScript(text) : "";
  if (safeText.length && safeText !== " ") {
    resetInputField();
    userMessage(safeText);
    send(safeText);
  }
  scrollDown();
  return;
};

const multiChoiceAnswer = text => {
  const decodedText = text.replace(/zzz/g, "'");
  userMessage(decodedText);
  send(decodedText);
  scrollDown();
  return;
};



const setResponse = (val, delay = 0) => {
  setTimeout(() => {
    aiMessage(processResponse(val));
  }, delay);
};

const resetInputField = () => {
  $chatbotInput.value = "";
};

const scrollDown = () => {
  const distanceToScroll =
    $chatbotMessageWindow.scrollHeight -
    ($chatbotMessages.lastChild.offsetHeight + 60);
  $chatbotMessageWindow.scrollTop = distanceToScroll;
  return false;
};

const send = (text = "") => {
  fetch(`${baseUrl}&query=${text}&lang=en&sessionId=${sessionId}`, {
    method: "GET",
    dataType: "json",
    headers: {
      Authorization: "Bearer " + accessToken,
      "Content-Type": "application/json; charset=utf-8"
    }
  })
    .then(response => response.json())
    .then(res => {
      if (res.status < 200 || res.status >= 300) {
        let error = new Error(res.statusText);
        throw error;
      }
      return res;
    })
    .then(res => {
      setResponse(res.result, loadingDelay + aiReplyDelay);
    })
    .catch(error => {
      setResponse(errorMessage, loadingDelay + aiReplyDelay);
      resetInputField();
      console.log(error);
    });

  aiMessage(loader, true, loadingDelay);
};


</script>
@yield('content')

@yield('scripts')
    
</body>

</html>