<template>
<div class="container">
  <div class="image">
      <img v-bind:src="path" v-bind:alt="name" height="auto" width="100%">
      <h4>{{name}}</h4>
  </div>
</div>
</template>

<script>
export default {
    data() {
        return{
            name:null,
            path:null
        }
    },
    created() {
        axios.get('/api/image')
             .then(data => {
                this.path = "/api/showImage/";
                this.path += data.data.data.path;
                this.name = data.data.data.name;
                console.log(this.path);
             })
    }
}
</script>