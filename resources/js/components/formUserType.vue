<template>
<div>
    <div class="form-group row">
        <label for="userType" class="col-md-4 col-form-label text-md-right">I am a:</label>

        <div class="col-md-6">
            <div class="form-check">
                <input class="form-check-input radio" type="radio" name="userType" id="patient" value="patient" checked v-model="userType">
                <label class="form-check-label" for="patient">
                    Patient
                </label>
            </div>

            <div class="form-check">
                <input class="form-check-input radio" type="radio" name="userType" id="carer" value="carer" v-model="userType">
                <label class="form-check-label" for="carer">
                    Carer
                </label>
            </div>
        </div>
    </div>

    <div class="form-group row" v-show="userType === 'carer'">
        <label for="patientEmail" class="col-md-4 col-form-label text-md-right">Patient's Email</label>

        <div class="col-md-6">
            <input id="patientEmail" type="email" class="form-control" name="patientEmail">
        </div>
    </div>
</div>
</template>

<script>

    export default {
        name: 'form-user-type',
        mounted() {
            console.log('Component mounted.')
        },
        data(){
            return{
                userType: 'patient'
            }
        }
    }
</script>
