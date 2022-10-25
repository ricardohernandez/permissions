export const permissions = {
  methods: {
    $can(permission) {
      return _permissions.indexOf(permission) !== -1;
    },

  },
};
