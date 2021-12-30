<template>
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <h3 class="panel-heading">List of users</h3>
          <div class="panel-body">
            <table class="table">
              <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
              </tr>
              </thead>
              <tbody>
              <tr v-for="user in users">
                <td>{{ user.id }}</td>
                <td>{{ user.name }}</td>
                <td>{{ user.email }}</td>
                <td>
                  <div v-if="authUser.is_admin">
                    <div>
                      <b-button @click="toggleUserBlocking(user)">{{ user.is_blocked ? 'Unblock' : 'Block'}}</b-button>
                      <b-button @click="deleteUser(user.id)">Delete</b-button>
                    </div>
                  </div>
                  <div v-else>
                    <div v-if="authUser.friendIds.indexOf(user.id) === -1">
                      <b-button @click="addFriend(user.id)">Add friend</b-button>
                    </div>
                    <div v-else>
                      <span>Already your friend</span>
                    </div>
                  </div>
                </td>
              </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data: function () {
    return {
      authUser: {
        friends: [],
        friendIds: [],
      },
      friend: '',
      target_user_id: '',
      users: {
        name: '',
        email: '',
      },
    }
  },
  mounted() {
    this.getAuthUser();
    this.getUsers();
  },

  methods: {
    getAuthUser() {
      this.$store.dispatch('getUser')
          .then(res => {
            if (res) {
              this.authUser = this.$store.getters.getUserData
              this.authUser.friendIds = this.authUser.friends.map(friend => friend.id);
            }
          }).catch((e) => console.log(e));
    },
    getUsers() {
      return new Promise((resolve, reject) => {
        axios.get('/users')
            .then(res => {
              if (res.status === 200) {
                this.users = res.data
                resolve(true)
              }
            })
            .catch(error => {
              reject(error)
            })
      })
    },
    addFriend(userId) {
      return new Promise((resolve, reject) => {
        axios.post('friend-request/send', {target_user_id: userId})
            .then(res => {
              if (res.status === 200) {
                alert(res.data.message);
                resolve(res);
              }
            })
            .catch(error => {
              reject(error)
            })
      })
    },
    toggleUserBlocking(user) {
      if (!this.authUser.is_admin) {
        return false;
      }

      axios.patch(`/admin/user/${user.is_blocked ? 'unblock' : 'block'}`, {userId: user.id}).then(res => {
        alert(res.data.message);
        this.getUsers();
      }).catch(err => console.log(err));
    },

    deleteUser(userId) {
      if (!this.authUser.is_admin) {
        return false;
      }

      axios.delete(`/admin/user/${userId}`).then(res => {
        alert(res.data.message);
        this.getUsers();
      }).catch(err => console.log(err));
    }
  }
}
</script>

<style scoped>

</style>
