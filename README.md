# hervision
--A project based on laravel Framework, mainly for female users to record the world around them
- Tools and Languages:  PHP,CSS,Javascript, JQUERY, MySQL, Redis,Vue.js,Ajax
- temporary website: http://forumjennifer2019.herokuapp.com/
---
Main Functions:
- Register/Login
- Create/Select/Delet/Update  threads ,comments, users,etc.
- poll : poll & vote
- notification : new subscriptions , commnets , likes are posted
- subscribe threads, like comments ,send  text message to other users, statistics personal data
- administrator module：update/delete users & threads, statistics online users& guests.
- localization: support switching between English and Chinese
---
Revision
- Add Email Confirmation 
#vue
- npm run watch  . must compileer first.
:value:  property added by developer
id : primitive property
<div v-for="portal in portals">
  <input type="radio"
         id="{{portal.id}}"
         name="portalSelect"
         v-bind:value="{id: portal.id, name: portal.name}"
         v-model="newPortalSelect"
         v-on:change="showSellers"
         :checked="portal.id == currentPortalId">

  <label for="{{portal.id}}">{{portal.name}}</label>
</div>

#chart line
LineChart.js, RandomChart.vue
#chart line2


