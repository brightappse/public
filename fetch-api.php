

<!DOCTYPE html>
<html lang="en-US">
<head>
<title>Vue fetch JSON</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
https://vuejs.org/v2/guide/#Handling-User-Input

<script src="vue.js"></script>
<h2>
fetch API JSON
</h2>

<h1>API APP</h1>
<div id="app">
 
      
      <h2>notify</h2>
        {{ notify.update }}
        {{ notify.user }}
        {{ notify.notification }}
      <div>Hämta innehålls array</div>
      <div v-for="item in notify.notification"> {{ item[0] }} {{ item[1] }} {{ item[2] }}</div>
      
      <h2>layout</h2>
        <div v-html="layout.form"></div>
        <div v-html="layout.about"></div>
      
      
      <h2>edit</h2>
      {{ edit }}
      <h2 v-html="edit.ID"></h2> 
        <h2 v-html="edit.title" v-once></h2>  <!-- uppdateras inte vid ändring -->
        <h2 v-html="edit.title"></h2>  <!-- NORMAL uppdateras vid ändring -->
        <h2 v-html="edit.url"></h2>   
        <h2 v-html="edit.date"></h2>
        
    
    {{ reversedMessage }}
    
    
    <p>DateTime</p>
    <h3>{{ DateTime }}</h3>
    
  </div> <!-- end app -->
     

<br>
 <button onclick="getdata('1')">1</button>
 <button onclick="getdata('2')">2</button> 
  <button onclick="getdata('10')">10</button>
    
    
    

    
<script>


/*
Hämtar json
Consume APIs
*/
// https://vuejs.org/v2/cookbook/using-axios-to-consume-apis.html

var testUrl = '';
var notifyUrl = 'http://brightapp.se/wpapi/notify/38c1491c617c48a6ed35bdcc1c8cf9a7/kommun.sitepublisher.se';
var editUrl =  'http://brightapp.se/wp_api?action=edit&token=38c1491c617c48a6ed35bdcc1c8cf9a7';
var layoutUrl =  'http://brightapp.se/wp_api?action=construct&token=38c1491c617c48a6ed35bdcc1c8cf9a7';

function geturl(a){
var api_url = editUrl + '&id='+a;
return api_url;
}

function getdata(id){
  if(id){ }else{ // us id or hash
     var id = window.location.hash.substr(1); // hash found
      }
   api.listFetch(id);// anrop vue func
   window.location.hash = id; // change hash
}

 

var api = new Vue({
  el: '#app',
  data: {
    
      edit: null,
      layout: null,
      notify: null,
      test: null,
  },
  mounted() {
    //axios
      //.get('https://api.coindesk.com/v1/bpi/currentprice.json')
      //.then(response => (this.info = response))
	     //this.read('10');
       this.layoutFetch(); // load func
       this.notifyFetch();
       this.testFetch();
  },
  
  methods: { // returnera som funktion 
      listFetch: function(id){
          fetch(geturl(id)) // static
          .then(response => response.json())
          .then(json => {this.edit = json });
      },
      
      layoutFetch: function(){
          fetch(layoutUrl) // static
          .then(response => response.json())
          .then(json => {this.layout = json });
      },
      
      notifyFetch: function(){
          fetch(notifyUrl) // static
          .then(response => response.json())
          .then(json => {this.notify = json });
      },
      
      testFetch: function(){
          if(testURl){
            fetch(testUrl) // static
            .then(response => response.json())
            .then(json => {this.test = json });
          }
      },
      
  
    
  },// methods

  computed: { // returnera funktionen som variabel
          // a computed getter
         reversedMessage: function () {
           // `this` points to the vm instance
           return this.edit.title.split('').reverse().join('')
         },
         
         DateTime: function () {
            return new Date();
       }
  },
  
})

getdata();
</script>
