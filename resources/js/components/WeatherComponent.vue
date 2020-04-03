<template>
<div class="container">
  <div v-if="errorStr">
    Sorry, but the following error
    occurred: {{errorStr}}
  </div>
    <div v-if="location">
        <div class="location">
            <h1 class="location-timezone">{{Timezone}}</h1>
        </div>
        <div class="temperature">
            <h1>{{temperature}}°C</h1>
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
            Timezone:null,
            temperature:null,
            tempdesc:null
        }
  },
  created() {
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
                this.Timezone = data.data.observations.location[0].state; 
                this.temperature = data.data.observations.location[0].observation[0].temperature;
                this.tempdesc = data.data.observations.location[0].observation[0].description;
                console.log(data.data.observations.location[0].observation[0]);
             })

    }, err => {
        this.errorStr = err.message;
    })
  }
}
</script>