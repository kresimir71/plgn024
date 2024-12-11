const dataToPost = formData => {
  return {
    username: formData.username.value,
    token: formData.token.value,
    advanced: {
      send_files_by_url: formData.advanced.sendFilesByUrl.value,
      clean_uninstall: formData.advanced.cleanUninstall.value,
      enable_logs: formData.advanced.enableLogs.value
    },
    boglemodule1: {
      active: formData.boglemodule1.active.value,
      username: formData.boglemodule1.username.value,
      token: formData.boglemodule1.token.value,
      boglemodule1option: {
        option: formData.boglemodule1.boglemodule1option.option.value,
        username: formData.boglemodule1.boglemodule1option.username.value,
        token: formData.boglemodule1.boglemodule1option.token.value
      }
    },
    example1module: {
      active: formData.example1module.active.value,
      channels: formData.example1module.channels.value,
      send_when: formData.example1module.sendWhen.value
    },
    example2module: {
      active: formData.example2module.active.value,
      chat_ids: formData.example2module.chatIds.value,
      watch_emails: formData.example2module.watchEmails.value
    }
  };
};
export default dataToPost;