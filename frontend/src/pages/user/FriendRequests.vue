<template>
  <b-container>
    <div class="mt-3">
      <h2>Incoming friend requests</h2>
      <div class="panel-body">
        <div class="panel-body" v-if="friendRequests.length > 0">
          <table class="table">
            <thead>
            <tr>
              <th>User name</th>
              <th>Date</th>
              <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="friendRequest in friendRequests">
              <td>{{ friendRequest.sender_user.name }}</td>
              <td>{{ friendRequest.created_at }}</td>
              <td>
                <div>
                  <button @click="acceptFriendRequest(friendRequest.id)">Accept</button>
                  <button @click="denyFriendRequest(friendRequest.id)">Deny</button>
                </div>
              </td>
            </tr>
            </tbody>
          </table>
        </div>
        <h4 class="text-center" v-else>You don't have friend requests.</h4>
      </div>
    </div>
  </b-container>
</template>

<script>
import axios from "axios";

export default {
  name: "FriendRequests",
  data() {
    return {
      friendRequests: [],
    }
  },
  mounted() {
    this.getFriendRequests();
  },
  methods: {
    getFriendRequests() {
      axios.get('/friend-request/received').then(res => {
            this.friendRequests = res.data;
          }
      ).catch(err => console.log(err));
    },
    acceptFriendRequest(friendRequestId) {
      axios.post('/friend-request/accept', {id: friendRequestId}).then(res => {
        if (res.status === 200) {
          this.getFriendRequests();
          alert(res.data.message);
        }
      }).catch(err => console.log(err));
    },
    denyFriendRequest(friendRequestId) {
      axios.post('/friend-request/deny', {id: friendRequestId}).then(res => {
        if (res.status === 200) {
          this.getFriendRequests();
          alert(res.data.message);
        }
      }).catch(err => console.log(err));
    }
  }
}
</script>

<style scoped>

</style>
