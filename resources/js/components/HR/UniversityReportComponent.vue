<template>
  <div class="small">
    <pie-chart :chart-data="datacollection" :options="options"></pie-chart>
  </div>
</template>

<script>
  import PieChart from './UniversityReport.js'

  export default {
    props: ['applications'],
    components: {
      PieChart
    },
    data () {
      return {
        datacollection: {},
        options:null
      }
    },
    mounted () { 
    console.log(this.applications)
      this.fillData()
    },
    methods: {
      fillData () {
        this.datacollection = {
          labels: this.applications.labels,
          datasets: [{
              borderWidth: 1,
              borderColor: this.applications.backgroundColor,
              backgroundColor: this.applications.backgroundColor,
              data: this.applications.data
            }]
        }
        this.options={
          legend: {
            display: true
          },
          responsive: true,
          maintainAspectRatio: false
        }
      }
    }
  }
</script>

<style>
  .small {
    max-width: 300px;
  }
</style>