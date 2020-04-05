<template>
<div class="container">
  <div v-if="errorStr">
    Sorry, but the following error
    occurred: {{errorStr}}
  </div>
    <div v-if="location">
        <div class="location">
            <h2>{{timenow}}</h2>
            <h4 class="date">{{datenow}}</h4>
        </div>
        <br>
        <div class="temperature">
            <h2>{{temperature}}°C</h2>
            <h4>{{tempdesc}}</h4>
        </div>
    </div>
</div>
</template>

<script>
export default {
    data() {
        return{
            location:null,
            gettingLocation: false,
            errorStr:null,
            temperature:null,
            tempdesc:null,
            datenow:null,
            timenow:null
        }
  },
  created() {
   this.interval = setInterval(this.time, 1000);   

    //do we support geolocation
    if(!("geolocation" in navigator)) {
        this.errorStr = 'Geolocation is not available.';
        return;
    }

    navigator.geolocation.getCurrentPosition(pos => {
        this.location = pos;
        let long = pos.coords.longitude;
        let lat = pos.coords.latitude;
        let url = '/api/weather/' + lat + ',' + long;
        axios.get(url)
             .then(data => {
                this.temperature = data.data.observations.location[0].observation[0].temperature;
                this.tempdesc = data.data.observations.location[0].observation[0].description;
                console.log(data.data.observations.location[0].observation[0]);
             })

    }, err => {
        this.errorStr = err.message;
    })
  },
  methods: {
      time: function() {
          this.datenow = moment().format('dddd [the] Do [of] MMMM, YYYY');
          this.timenow = moment().format('h:mm a');

      }
  }
}
</script>