
    //   (function () {
    //     // encrypt value
    //     let valueToEncrypt = 'foobar' // this could also be object/array/whatever
    //     let password = '123456'
    //     let encrypted = CryptoJSAesJson.encrypt(valueToEncrypt, password)
    //     console.log('Encrypted:', encrypted)
    //     // something like: {"ct":"10MOxNzbZ7vqR3YEoOhKMg==","iv":"9700d78e12910b5cccd07304333102b7","s":"c6b0b7a3dc072248"}
    //   })();

      (function () {
        // decrypt value
        let encrypted = '{"ct":"hQDvpbAKTGp1mXgzSShR9g==","iv":"57fd85773d898d1f9f868c53b436e28f","s":"a2dac436512077c5"}'
        let password = '123456'
        let decrypted = CryptoJSAesJson.decrypt(encrypted, password)
        console.log('Decrypted:', decrypted)
      })();
