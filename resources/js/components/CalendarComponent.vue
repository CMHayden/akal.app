<template>
<div class="row justify-content-center">
  <div class="col-md-3">
    <h3 v-if="addingMode">Add New Event</h3>
    <template v-else><h3>Edit or Delete</h3></template>
    <br>
    <form @submit.prevent>
      <div class="form-group">
        <label for="event_name">Event Name</label>
        <input type="text" id="event_name" class="form-control" v-model="newEvent.event_name" required>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="start_date">Start Date</label>
            <input
              type="date"
              id="start_date"
              class="form-control"
              v-model="newEvent.start_date"
            >
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="end_date">End Date</label>
            <input type="date" id="end_date" class="form-control" v-model="newEvent.end_date">
          </div>
        </div>
        <div class="col-md-6 mb-4" v-if="addingMode">
          <button class="btn btn-sm btn-primary " @click="addNewEvent">Save Event</button>
        </div>
        <template v-else>
          <div class="col-md-6 mb-4">
            <button class="btn btn-sm btn-success" @click="updateEvent">Update</button>
            <button class="btn btn-sm btn-danger" @click="deleteEvent">Delete</button>
            <button class="btn btn-sm btn-secondary" @click="addingMode = !addingMode">Cancel</button>
          </div>
        </template>
      </div>
    </form>
    <br>
    <br>
    <h3>Patient details</h3>
    Name: {{patient_name}} <br>
    Email: {{patient_email}} <br>
    Max temperature: {{max_temp}}°C <br>
    Min temperature: {{min_temp}}°C

  </div>
  <div class="col-md-6 calendar">
        <Fullcalendar @eventClick="showEvent" :plugins="calendarPlugins" :events="events"/>
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
      newEvent: {
        event_name: "",
        start_date: "",
        end_date: ""
      },
      addingMode: true,
      indexToUpdate: "",
      patient_name: null,
      patient_email: null,
      min_temp: null,
      max_temp: null
    };
  },
  created() {
    this.getEvents();
    this.getPatientDetails();
  },
  methods: {
    addNewEvent() {
      axios
        .post("/api/calendar", {
          ...this.newEvent
        })
        .then(data => {
          this.getEvents(); // update our list of events
          this.resetForm(); // clear newEvent properties (e.g. title, start_date and end_date)
        })
        .catch(err =>
          console.log("Unable to add new event!", err.response.data)
        );
    },
    showEvent(arg) {
      this.addingMode = false;
      const { id, title, start, end } = this.events.find(
        event => event.id === +arg.event.id
      );
      this.indexToUpdate = id;
      this.newEvent = {
        event_name: title,
        start_date: start,
        end_date: end
      };
    },
    updateEvent() {
      axios
        .put("/api/calendar/" + this.indexToUpdate, {
          ...this.newEvent
        })
        .then(resp => {
          this.resetForm();
          this.getEvents();
          this.addingMode = !this.addingMode;
        })
        .catch(err =>
          console.log("Unable to update event!", err.response.data)
        );
    },
    deleteEvent() {
      axios
        .delete("/api/calendar/" + this.indexToUpdate)
        .then(resp => {
          this.resetForm();
          this.getEvents();
          this.addingMode = !this.addingMode;
        })
        .catch(err =>
          console.log("Unable to delete event!", err.response.data)
        );
    },
    getEvents() {
      axios
        .get("/api/calendar")
        .then(resp => (this.events = resp.data.data))
        .catch(err => console.log(err.response.data));
    },
    resetForm() {
      Object.keys(this.newEvent).forEach(key => {
        return (this.newEvent[key] = "");
      });
    },
    getPatientDetails() {
      axios
        .get("/api/patientdetails")
        .then(resp => (
          this.patient_email = resp.data[0].email,
          this.patient_name = resp.data[0].name
        ))
        .catch(err => console.warn(err.response.data));
      
      axios
        .get("/api/temperature")
        .then(resp => (
          this.min_temp = resp.data.data[0].minTemp,
          this.max_temp = resp.data.data[0].maxTemp,
          console.log(resp.data.data[0])
        ))
    }
  },
  watch: {
    indexToUpdate() {
      return this.indexToUpdate;
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
</style>