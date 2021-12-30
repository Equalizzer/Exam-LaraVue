import Profile from './Profile';
import AllUsers from "./AllUsers";
import FriendRequests from "./FriendRequests";

export default [
    {
        path: '/profile',
        name: 'Profile',
        component: Profile,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/users',
        name: 'AllUsers',
        component: AllUsers,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/friend-requests',
        name: 'FriendRequests',
        component: FriendRequests,
        meta: {
            requiresAuth: true
        }
    },
]

