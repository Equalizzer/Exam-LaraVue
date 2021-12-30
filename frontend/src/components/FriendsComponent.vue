<template>
  <div class="mt-3">
    <h2>Your friends</h2>
    <div class="panel-body">
      <b-table striped hover :items="friendsData" v-if="friendsData.length > 0"></b-table>
      <h4 class="text-center" v-else>You are alone :(</h4>
    </div>
  </div>
</template>

<script>
export default {
  name: "FriendsComponent",
  props: [
    'friendsData'
  ]
}
</script>

<style scoped>

</style>
