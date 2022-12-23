const inputValidation = (str, id, howMutch) => {
    const lng = str.length;
    document.getElementById(id).innerHTML = `${lng} out of the ${howMutch} characters`;
};