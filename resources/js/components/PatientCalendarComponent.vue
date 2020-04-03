<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <Fullcalendar :plugins="calendarPlugins" :events="events"/>
      </div>
    </div>
  </div>
</template>

<script>
import Fullcalendar from "@fullcalendar/vue";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";
import axios from "axios";

export default {
  components: {
    Fullcalendar
  },
  data() {
    return {
      calendarPlugins: [dayGridPlugin, interactionPlugin],
      events: "",
    };
  },
  created() {
    this.getEvents();
  },
  methods: {
    getEvents() {
      axios
        .get("/api/calendar")
        .then(resp => (this.events = resp.data.data))
        .catch(err => console.log(err.response.data));
    }
  }
};
</script>

<style lang="css">
@import "~@fullcalendar/core/main.css";
@import "~@fullcalendar/daygrid/main.css";
.fc-title:hover {
  cursor: pointer;
}

.container {
    max-height: 90%;
}
</style>