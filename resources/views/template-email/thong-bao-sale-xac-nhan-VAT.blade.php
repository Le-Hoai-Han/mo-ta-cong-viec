<!-- NAME: SELL PRODUCTS -->
<!--[if gte mso 15]>
        <xml>
            <o:OfficeDocumentSettings>
            <o:AllowPNG></o:AllowPNG>
            <o:PixelsPerInch>96</o:PixelsPerInch>
            </o:OfficeDocumentSettings>
        </xml>
        <![endif]-->
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>3DS triển khai đơn hàng {{$donHang->ma_don_hang}}</title>
        
        <style type="text/css">
            p {
                margin: 10px 0;
                padding: 0;
            }
            
            table {
                border-collapse: collapse;
            }
            
            h1,
            h2,
            h3,
            h4,
            h5,
            h6 {
                display: block;
                margin: 0;
                padding: 0;
            }
            
            img,
            a img {
                border: 0;
                height: auto;
                outline: none;
                text-decoration: none;
            }
            
            body,
            #bodyTable,
            #bodyCell {
                height: 100%;
                margin: 0;
                padding: 0;
                width: 100%;
            }
            
            .table_sp,
            .th_sp,
            .td_sp {
                border: 1px solid black;
                border-collapse: collapse;
                padding: 3px;
            }
            
            .mcnPreviewText {
                display: none !important;
            }
            
            #outlook a {
                padding: 0;
            }
            
            img {
                -ms-interpolation-mode: bicubic;
            }
            
            table {
                mso-table-lspace: 0pt;
                mso-table-rspace: 0pt;
            }
            
            .ReadMsgBody {
                width: 100%;
            }
            
            .ExternalClass {
                width: 100%;
            }
            
            p,
            a,
            li,
            td,
            blockquote {
                mso-line-height-rule: exactly;
            }
            
            a[href^=tel],
            a[href^=sms] {
                color: inherit;
                cursor: default;
                text-decoration: none;
            }
            
            p,
            a,
            li,
            td,
            body,
            table,
            blockquote {
                -ms-text-size-adjust: 100%;
                -webkit-text-size-adjust: 100%;
            }
            
            .ExternalClass,
            .ExternalClass p,
            .ExternalClass td,
            .ExternalClass div,
            .ExternalClass span,
            .ExternalClass font {
                line-height: 100%;
            }
            
            a[x-apple-data-detectors] {
                color: inherit !important;
                text-decoration: none !important;
                font-size: inherit !important;
                font-family: inherit !important;
                font-weight: inherit !important;
                line-height: inherit !important;
            }
            
            .templateContainer {
                max-width: 600px !important;
            }
            
            a.mcnButton {
                display: block;
            }
            
            .mcnImage,
            .mcnRetinaImage {
                vertical-align: bottom;
            }
            
            .mcnTextContent {
                word-break: break-word;
            }
            
            .mcnTextContent img {
                height: auto !important;
            }
            
            .mcnDividerBlock {
                table-layout: fixed !important;
            }
            
            h1 {
                color: #222222;
                font-family: Helvetica;
                font-size: 40px;
                font-style: normal;
                font-weight: bold;
                line-height: 150%;
                letter-spacing: normal;
                text-align: center;
            }
            
            h2 {
                color: #222222;
                font-family: Helvetica;
                font-size: 34px;
                font-style: normal;
                font-weight: bold;
                line-height: 150%;
                letter-spacing: normal;
                text-align: left;
            }
            
            h3 {
                color: #444444;
                font-family: Helvetica;
                font-size: 22px;
                font-style: normal;
                font-weight: bold;
                line-height: 150%;
                letter-spacing: normal;
                text-align: left;
            }
            
            h4 {
                color: #949494;
                font-family: Georgia;
                font-size: 20px;
                font-style: italic;
                font-weight: normal;
                line-height: 125%;
                letter-spacing: normal;
                text-align: left;
            }
            
            #templateHeader {
                background-color: #transparent;
                background-image: none;
                background-repeat: no-repeat;
                background-position: center;
                background-size: cover;
                border-top: 0;
                border-bottom: 0;
                padding-top: 0px;
                padding-bottom: 0px;
            }
            
            .headerContainer {
                background-color: transparent;
                background-image: none;
                background-repeat: no-repeat;
                background-position: center;
                background-size: cover;
                border-top: 0;
                border-bottom: 0;
                padding-top: 0;
                padding-bottom: 0;
            }
            
            .headerContainer .mcnTextContent,
            .headerContainer .mcnTextContent p {
                color: #757575;
                font-family: Helvetica;
                font-size: 16px;
                line-height: 150%;
                text-align: left;
            }
            
            .headerContainer .mcnTextContent a,
            .headerContainer .mcnTextContent p a {
                color: #007C89;
                font-weight: normal;
                text-decoration: underline;
            }
            
            #templateBody {
                background-color: #FFFFFF;
                background-image: none;
                background-repeat: no-repeat;
                background-position: center;
                background-size: cover;
                border-top: 0;
                border-bottom: 0;
                padding-top: 0px;
                padding-bottom: 0px;
            }
            
            .bodyContainer {
                background-color: transparent;
                background-image: none;
                background-repeat: no-repeat;
                background-position: center;
                background-size: cover;
                border-top: 0;
                border-bottom: 0;
                padding-top: 0;
                padding-bottom: 0;
            }
            
            .bodyContainer .mcnTextContent,
            .bodyContainer .mcnTextContent p {
                color: #757575;
                font-family: Helvetica;
                font-size: 16px;
                line-height: 150%;
                text-align: left;
            }
            
            .bodyContainer .mcnTextContent a,
            .bodyContainer .mcnTextContent p a {
                color: #007C89;
                font-weight: normal;
                text-decoration: underline;
            }
            
            #templateFooter {
                background-color: #fff;
                background-image: none;
                background-repeat: no-repeat;
                background-position: center;
                background-size: cover;
                border-top: 0;
                border-bottom: 0;
                padding-top: 0px;
                padding-bottom: 0px;
            }
            
            .footerContainer {
                background-color: transparent;
                background-image: none;
                background-repeat: no-repeat;
                background-position: center;
                background-size: cover;
                border-top: 0;
                border-bottom: 0;
                padding-top: 0;
                padding-bottom: 0;
            }
            
            .footerContainer .mcnTextContent,
            .footerContainer .mcnTextContent p {
                color: #FFFFFF;
                font-family: Helvetica;
                font-size: 12px;
                line-height: 150%;
                text-align: center;
            }
            
            .footerContainer .mcnTextContent a,
            .footerContainer .mcnTextContent p a {
                color: #FFFFFF;
                font-weight: normal;
                text-decoration: underline;
            }
            
            @media only screen and (min-width:768px) {
                .templateContainer {
                    width: 600px !important;
                }
            }
            
            @media only screen and (max-width: 480px) {
                body,
                table,
                td,
                p,
                a,
                li,
                blockquote {
                    -webkit-text-size-adjust: none !important;
                }
            }
            
            @media only screen and (max-width: 480px) {
                body {
                    width: 100% !important;
                    min-width: 100% !important;
                }
            }
            
            @media only screen and (max-width: 480px) {
                .mcnRetinaImage {
                    max-width: 100% !important;
                }
            }
            
            @media only screen and (max-width: 480px) {
                .mcnImage {
                    width: 100% !important;
                }
            }
            
            @media only screen and (max-width: 480px) {
                .mcnCartContainer,
                .mcnCaptionTopContent,
                .mcnRecContentContainer,
                .mcnCaptionBottomContent,
                .mcnTextContentContainer,
                .mcnBoxedTextContentContainer,
                .mcnImageGroupContentContainer,
                .mcnCaptionLeftTextContentContainer,
                .mcnCaptionRightTextContentContainer,
                .mcnCaptionLeftImageContentContainer,
                .mcnCaptionRightImageContentContainer,
                .mcnImageCardLeftTextContentContainer,
                .mcnImageCardRightTextContentContainer,
                .mcnImageCardLeftImageContentContainer,
                .mcnImageCardRightImageContentContainer {
                    max-width: 100% !important;
                    width: 100% !important;
                }
            }
            
            @media only screen and (max-width: 480px) {
                .mcnBoxedTextContentContainer {
                    min-width: 100% !important;
                }
            }
            
            @media only screen and (max-width: 480px) {
                .mcnImageGroupContent {
                    padding: 9px !important;
                }
            }
            
            @media only screen and (max-width: 480px) {
                .mcnCaptionLeftContentOuter .mcnTextContent,
                .mcnCaptionRightContentOuter .mcnTextContent {
                    padding-top: 9px !important;
                }
            }
            
            @media only screen and (max-width: 480px) {
                .mcnImageCardTopImageContent,
                .mcnCaptionBottomContent:last-child .mcnCaptionBottomImageContent,
                .mcnCaptionBlockInner .mcnCaptionTopContent:last-child .mcnTextContent {
                    padding-top: 18px !important;
                }
            }
            
            @media only screen and (max-width: 480px) {
                .mcnImageCardBottomImageContent {
                    padding-bottom: 9px !important;
                }
            }
            
            @media only screen and (max-width: 480px) {
                .mcnImageGroupBlockInner {
                    padding-top: 0 !important;
                    padding-bottom: 0 !important;
                }
            }
            
            @media only screen and (max-width: 480px) {
                .mcnImageGroupBlockOuter {
                    padding-top: 9px !important;
                    padding-bottom: 9px !important;
                }
            }
            
            @media only screen and (max-width: 480px) {
                .mcnTextContent,
                .mcnBoxedTextContentColumn {
                    padding-right: 18px !important;
                    padding-left: 18px !important;
                }
            }
            
            @media only screen and (max-width: 480px) {
                .mcnImageCardLeftImageContent,
                .mcnImageCardRightImageContent {
                    padding-right: 18px !important;
                    padding-bottom: 0 !important;
                    padding-left: 18px !important;
                }
            }
            
            @media only screen and (max-width: 480px) {
                .mcpreview-image-uploader {
                    display: none !important;
                    width: 100% !important;
                }
            }
            
            @media only screen and (max-width: 480px) {
                h1 {
                    font-size: 30px !important;
                    line-height: 125% !important;
                }
            }
            
            @media only screen and (max-width: 480px) {
                h2 {
                    font-size: 26px !important;
                    line-height: 125% !important;
                }
            }
            
            @media only screen and (max-width: 480px) {
                h3 {
                    font-size: 20px !important;
                    line-height: 150% !important;
                }
            }
            
            @media only screen and (max-width: 480px) {
                h4 {
                    font-size: 18px !important;
                    line-height: 150% !important;
                }
            }
            
            @media only screen and (max-width: 480px) {
                .mcnBoxedTextContentContainer .mcnTextContent,
                .mcnBoxedTextContentContainer .mcnTextContent p {
                    font-size: 14px !important;
                    line-height: 150% !important;
                }
            }
            
            @media only screen and (max-width: 480px) {
                .headerContainer .mcnTextContent,
                .headerContainer .mcnTextContent p {
                    font-size: 16px !important;
                    line-height: 150% !important;
                }
            }
            
            @media only screen and (max-width: 480px) {
                .bodyContainer .mcnTextContent,
                .bodyContainer .mcnTextContent p {
                    font-size: 16px !important;
                    line-height: 150% !important;
                }
            }
            
            @media only screen and (max-width: 480px) {
                .footerContainer .mcnTextContent,
                .footerContainer .mcnTextContent p {
                    font-size: 14px !important;
                    line-height: 150% !important;
                }
            }
        </style>
        
        <!--
                                                -->
        <center>
            <table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;height: 100%;margin: 0;padding: 0;width: 100%;">
                <tbody>
                    <tr>
                        <td align="center" valign="top" id="bodyCell" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;height: 100%;margin: 0;padding: 0;width: 100%;">
                            <!-- BEGIN TEMPLATE // -->
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                <tbody>
                                    <tr>
                                        <td align="center" valign="top" id="templateHeader" data-template-container="" style="background:#transparent none no-repeat center/cover;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #transparent;background-image: none;background-repeat: no-repeat;background-position: center;background-size: cover;border-top: 0;border-bottom: 0;padding-top: 0px;padding-bottom: 0px;">
                                            <!--[if (gte mso 9)|(IE)]>
                                                                                    <table align="center" border="0" cellspacing="0" cellpadding="0" width="600" style="width:600px;">
                                                                                    <tr>
                                                                                    <td align="center" valign="top" width="600" style="width:600px;">
                                                                                    <![endif]-->
                                            <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" class="templateContainer" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;max-width: 600px !important;">
                                                <tbody>
                                                    <tr>
                                                        <td valign="top" class="headerContainer" style="background:transparent none no-repeat center/cover;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: transparent;background-image: none;background-repeat: no-repeat;background-position: center;background-size: cover;border-top: 0;border-bottom: 0;padding-top: 0;padding-bottom: 0;">
                                                            <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnImageBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                <tbody class="mcnImageBlockOuter">
                                                                    <tr>
                                                                        <td valign="top" style="padding: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" class="mcnImageBlockInner">
                                                                            <table align="left" width="100%" border="0" cellpadding="0" cellspacing="0" class="mcnImageContentContainer" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td class="mcnImageContent" valign="top" style="padding-right: 9px;padding-left: 9px;padding-top: 0;padding-bottom: 0;text-align: center;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
        
                                                                                            <a href="https://3d-smartsolutions.com" title="3D Smart Solutions Co., Ltd." class="" target="_blank" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                                                <img align="center" alt="" src="https://mcusercontent.com/8902e67be1e32c548107a04f2/images/b53d766a-2d43-46a0-a48a-96c5fd6b2435.png" width="135.35999999999999" style="max-width: 1000px;padding-bottom: 0;display: inline !important;vertical-align: bottom;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;"
                                                                                                    class="mcnImage">
                                                                                            </a>
        
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <!--[if (gte mso 9)|(IE)]>
                                                                                    </td>
                                                                                    </tr>
                                                                                    </table>
                                                                                    <![endif]-->
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center" valign="top" id="templateBody" data-template-container="" style="background:#FFFFFF none no-repeat center/cover;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #FFFFFF;background-image: none;background-repeat: no-repeat;background-position: center;background-size: cover;border-top: 0;border-bottom: 0;padding-top: 0px;padding-bottom: 0px;">
                                            <!--[if (gte mso 9)|(IE)]>
                                                                                    <table align="center" border="0" cellspacing="0" cellpadding="0" width="600" style="width:600px;">
                                                                                    <tr>
                                                                                    <td align="center" valign="top" width="600" style="width:600px;">
                                                                                    <![endif]-->
                                            <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" class="templateContainer" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;max-width: 600px !important;">
                                                <tbody>
                                                    <tr>
                                                        <td valign="top" class="bodyContainer" style="background:transparent none no-repeat center/cover;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: transparent;background-image: none;background-repeat: no-repeat;background-position: center;background-size: cover;border-top: 0;border-bottom: 0;padding-top: 0;padding-bottom: 0;">
                                                            <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnImageBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                <tbody class="mcnImageBlockOuter">
                                                                    <tr>
                                                                        <td valign="top" style="padding: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" class="mcnImageBlockInner">
                                                                            <table align="left" width="100%" border="0" cellpadding="0" cellspacing="0" class="mcnImageContentContainer" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td class="mcnImageContent" valign="top" style="padding-right: 9px;padding-left: 9px;padding-top: 0;padding-bottom: 0;text-align: center;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
        
                                                                                            <a href="https://3d-smartsolutions.com/gioi-thieu-cong-ty-3d-smart-solutions/" title="" class="" target="_blank" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                                                <img align="center" alt="" src="https://mcusercontent.com/8902e67be1e32c548107a04f2/images/9a00fe00-d16e-42f9-b8e0-93e056e007cf.jpg" width="564" style="max-width: 1000px;padding-bottom: 0;display: inline !important;vertical-align: bottom;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;"
                                                                                                    class="mcnImage">
                                                                                            </a>
        
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                <tbody class="mcnTextBlockOuter">
                                                                    <tr>
                                                                        <td valign="top" class="mcnTextBlockInner" style="padding-top: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                            <!--[if mso]>
                                                                <table align="left" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
                                                                <tr>
                                                                <![endif]-->
        
                                                                            <!--[if mso]>
                                                                <td valign="top" width="600" style="width:600px;">
                                                                <![endif]-->
                                                                            <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width: 100%;min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" width="100%" class="mcnTextContentContainer">
                                                                                <tbody>
                                                                                    <tr>
        
                                                                                        <td valign="top" class="mcnTextContent" style="padding: 0px 18px 9px;line-height: 150%;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;color: #757575;font-family: Helvetica;font-size: 16px;text-align: left;">
                                                                                            <h3 style="text-align: justify;display: block;margin: 0;padding: 0;color: #444444;font-family: Helvetica;font-size: 22px;font-style: normal;font-weight: bold;line-height: 150%;letter-spacing: normal;">Kính gửi {{$donHang->nhanVien->user->name}}</h3>
                                                                                            <p style="text-align: justify;line-height: 150%;margin: 10px 0;padding: 0;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #757575;font-family: Helvetica;font-size: 16px;">Đơn hàng của bạn thực hiện có giá trị VAT bằng 0</p>
                                                                                            <p style="text-align: justify;line-height: 150%;margin: 10px 0;padding: 0;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #757575;font-family: Helvetica;font-size: 16px;">Mã số đơn hàng: <strong>{{$donHang->ma_don_hang}}</p>
                                                                                            <p style="text-align: justify;line-height: 150%;margin: 10px 0;padding: 0;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #757575;font-family: Helvetica;font-size: 16px;">Vui lòng kiểm tra lại đơn hàng,nếu VAT bằng 0 thì vui lòng xác nhận bằng cách click vào link bên dưới</p>
                                                                                            <a href="{{$link}}">{{$link}}</a>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                            <!--[if mso]>
                                                                </td>
                                                                <![endif]-->
        
                                                                            <!--[if mso]>
                                                                </tr>
                                                                </table>
                                                                <![endif]-->
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
        
                                                            <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                <tbody class="mcnTextBlockOuter">
                                                                    <tr>
                                                                        <td valign="top" class="mcnTextBlockInner" style="padding-top: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                            <!--[if mso]>
                                                                <table align="left" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
                                                                <tr>
                                                                <![endif]-->
        
                                                                            <!--[if mso]>
                                                                <td valign="top" width="600" style="width:600px;">
                                                                <![endif]-->
                                                                            <!--[if mso]>
                                                                </td>
                                                                <![endif]-->
        
                                                                            <!--[if mso]>
                                                                </tr>
                                                                </table>
                                                                <![endif]-->
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <!--[if (gte mso 9)|(IE)]>
                                                                                    </td>
                                                                                    </tr>
                                                                                    </table>
                                                                                    <![endif]-->
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center" valign="top" id="templateFooter" data-template-container="" style="background:#fff none no-repeat center/cover;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #fff;background-image: none;background-repeat: no-repeat;background-position: center;background-size: cover;border-top: 0;border-bottom: 0;padding-top: 0px;padding-bottom: 0px;">
                                            <!--[if (gte mso 9)|(IE)]>
                                                                                    <table align="center" border="0" cellspacing="0" cellpadding="0" width="600" style="width:600px;">
                                                                                    <tr>
                                                                                    <td align="center" valign="top" width="600" style="width:600px;">
                                                                                    <![endif]-->
                                            <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" class="templateContainer" style="background-color:#b81717;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;max-width: 600px !important;">
                                                <tbody>
                                                    <tr>
                                                        <td valign="top" class="footerContainer" style="background:transparent none no-repeat center/cover;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: transparent;background-image: none;background-repeat: no-repeat;background-position: center;background-size: cover;border-top: 0;border-bottom: 0;padding-top: 0;padding-bottom: 0;">
                                                            <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnFollowBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                <tbody class="mcnFollowBlockOuter">
                                                                    <tr>
                                                                        <td align="center" valign="top" style="padding: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color:#b81717;" class="mcnFollowBlockInner">
                                                                            <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnFollowContentContainer" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td align="center" style="padding-left: 9px;padding-right: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                                            <table border="0" cellpadding="0" cellspacing="0" class="mcnFollowContent" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td align="center" valign="top" style="padding-top: 9px;padding-right: 9px;padding-left: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                                                            <table align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                                                                <tbody>
                                                                                                                    <tr>
                                                                                                                        <td align="center" valign="top" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                                                                            <!--[if mso]>
                                                                                    <table align="center" border="0" cellspacing="0" cellpadding="0">
                                                                                    <tr>
                                                                                    <![endif]-->
        
                                                                                                                            <!--[if mso]>
                                                                                        <td align="center" valign="top">
                                                                                        <![endif]-->
        
        
                                                                                                                            <table align="left" border="0" cellpadding="0" cellspacing="0" style="display: inline;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                                                                                <tbody>
                                                                                                                                    <tr>
                                                                                                                                        <td valign="top" style="padding-right: 10px;padding-bottom: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" class="mcnFollowContentItemContainer">
                                                                                                                                            <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnFollowContentItem" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                                                                                                <tbody>
                                                                                                                                                    <tr>
                                                                                                                                                        <td align="left" valign="middle" style="padding-top: 5px;padding-right: 10px;padding-bottom: 5px;padding-left: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                                                                                                            <table align="left" border="0" cellpadding="0" cellspacing="0" width="" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                                                                                                                <tbody>
                                                                                                                                                                    <tr>
        
                                                                                                                                                                        <td align="center" valign="middle" width="24" class="mcnFollowIconContent" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                                                                                                                            <a href="https://www.facebook.com/3DSmartSolutionsCompany/" target="_blank" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;"><img src="https://cdn-images.mailchimp.com/icons/social-block-v2/outline-light-facebook-48.png"
                                                                                                                                                                                    alt="3DS Fanpage" style="display: block;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;"
                                                                                                                                                                                    height="24" width="24" class=""></a>
                                                                                                                                                                        </td>
        
        
                                                                                                                                                                    </tr>
                                                                                                                                                                </tbody>
                                                                                                                                                            </table>
                                                                                                                                                        </td>
                                                                                                                                                    </tr>
                                                                                                                                                </tbody>
                                                                                                                                            </table>
                                                                                                                                        </td>
                                                                                                                                    </tr>
                                                                                                                                </tbody>
                                                                                                                            </table>
        
                                                                                                                            <!--[if mso]>
                                                                                        </td>
                                                                                        <![endif]-->
        
                                                                                                                            <!--[if mso]>
                                                                                        <td align="center" valign="top">
                                                                                        <![endif]-->
        
        
                                                                                                                            <table align="left" border="0" cellpadding="0" cellspacing="0" style="display: inline;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                                                                                <tbody>
                                                                                                                                    <tr>
                                                                                                                                        <td valign="top" style="padding-right: 10px;padding-bottom: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" class="mcnFollowContentItemContainer">
                                                                                                                                            <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnFollowContentItem" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                                                                                                <tbody>
                                                                                                                                                    <tr>
                                                                                                                                                        <td align="left" valign="middle" style="padding-top: 5px;padding-right: 10px;padding-bottom: 5px;padding-left: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                                                                                                            <table align="left" border="0" cellpadding="0" cellspacing="0" width="" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                                                                                                                <tbody>
                                                                                                                                                                    <tr>
        
                                                                                                                                                                        <td align="center" valign="middle" width="24" class="mcnFollowIconContent" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                                                                                                                            <a href="https://www.linkedin.com/company/3d-smart-solutions/" target="_blank" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;"><img src="https://cdn-images.mailchimp.com/icons/social-block-v2/outline-light-linkedin-48.png"
                                                                                                                                                                                    alt="3DS LinkedIn" style="display: block;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;"
                                                                                                                                                                                    height="24" width="24" class=""></a>
                                                                                                                                                                        </td>
        
        
                                                                                                                                                                    </tr>
                                                                                                                                                                </tbody>
                                                                                                                                                            </table>
                                                                                                                                                        </td>
                                                                                                                                                    </tr>
                                                                                                                                                </tbody>
                                                                                                                                            </table>
                                                                                                                                        </td>
                                                                                                                                    </tr>
                                                                                                                                </tbody>
                                                                                                                            </table>
        
                                                                                                                            <!--[if mso]>
                                                                                        </td>
                                                                                        <![endif]-->
        
                                                                                                                            <!--[if mso]>
                                                                                        <td align="center" valign="top">
                                                                                        <![endif]-->
        
        
                                                                                                                            <table align="left" border="0" cellpadding="0" cellspacing="0" style="display: inline;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                                                                                <tbody>
                                                                                                                                    <tr>
                                                                                                                                        <td valign="top" style="padding-right: 10px;padding-bottom: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" class="mcnFollowContentItemContainer">
                                                                                                                                            <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnFollowContentItem" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                                                                                                <tbody>
                                                                                                                                                    <tr>
                                                                                                                                                        <td align="left" valign="middle" style="padding-top: 5px;padding-right: 10px;padding-bottom: 5px;padding-left: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                                                                                                            <table align="left" border="0" cellpadding="0" cellspacing="0" width="" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                                                                                                                <tbody>
                                                                                                                                                                    <tr>
        
                                                                                                                                                                        <td align="center" valign="middle" width="24" class="mcnFollowIconContent" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                                                                                                                            <a href="https://www.youtube.com/3d-smartsolutions" target="_blank" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;"><img src="https://cdn-images.mailchimp.com/icons/social-block-v2/outline-light-youtube-48.png"
                                                                                                                                                                                    alt="3DS Channel" style="display: block;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;"
                                                                                                                                                                                    height="24" width="24" class=""></a>
                                                                                                                                                                        </td>
        
        
                                                                                                                                                                    </tr>
                                                                                                                                                                </tbody>
                                                                                                                                                            </table>
                                                                                                                                                        </td>
                                                                                                                                                    </tr>
                                                                                                                                                </tbody>
                                                                                                                                            </table>
                                                                                                                                        </td>
                                                                                                                                    </tr>
                                                                                                                                </tbody>
                                                                                                                            </table>
        
                                                                                                                            <!--[if mso]>
                                                                                        </td>
                                                                                        <![endif]-->
        
                                                                                                                            <!--[if mso]>
                                                                                        <td align="center" valign="top">
                                                                                        <![endif]-->
        
        
                                                                                                                            <table align="left" border="0" cellpadding="0" cellspacing="0" style="display: inline;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                                                                                <tbody>
                                                                                                                                    <tr>
                                                                                                                                        <td valign="top" style="padding-right: 0;padding-bottom: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" class="mcnFollowContentItemContainer">
                                                                                                                                            <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnFollowContentItem" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                                                                                                <tbody>
                                                                                                                                                    <tr>
                                                                                                                                                        <td align="left" valign="middle" style="padding-top: 5px;padding-right: 10px;padding-bottom: 5px;padding-left: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                                                                                                            <table align="left" border="0" cellpadding="0" cellspacing="0" width="" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                                                                                                                <tbody>
                                                                                                                                                                    <tr>
        
                                                                                                                                                                        <td align="center" valign="middle" width="24" class="mcnFollowIconContent" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                                                                                                                            <a href="https://3d-smartsolutions.com" target="_blank" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;"><img src="https://cdn-images.mailchimp.com/icons/social-block-v2/outline-light-link-48.png"
                                                                                                                                                                                    alt="3DS Website" style="display: block;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;"
                                                                                                                                                                                    height="24" width="24" class=""></a>
                                                                                                                                                                        </td>
        
        
                                                                                                                                                                    </tr>
                                                                                                                                                                </tbody>
                                                                                                                                                            </table>
                                                                                                                                                        </td>
                                                                                                                                                    </tr>
                                                                                                                                                </tbody>
                                                                                                                                            </table>
                                                                                                                                        </td>
                                                                                                                                    </tr>
                                                                                                                                </tbody>
                                                                                                                            </table>
        
                                                                                                                            <!--[if mso]>
                                                                                        </td>
                                                                                        <![endif]-->
        
                                                                                                                            <!--[if mso]>
                                                                                    </tr>
                                                                                    </table>
                                                                                    <![endif]-->
                                                                                                                        </td>
                                                                                                                    </tr>
                                                                                                                </tbody>
                                                                                                            </table>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
        
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnDividerBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;table-layout: fixed !important;">
                                                                <tbody class="mcnDividerBlockOuter">
                                                                    <tr>
                                                                        <td class="mcnDividerBlockInner" style="min-width: 100%;padding: 0px 18px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                            <table class="mcnDividerContent" border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width: 100%;border-top: 2px solid #EAEAEA;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                                            <span></span>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                            <!--
                                                                <td class="mcnDividerBlockInner" style="padding: 18px;">
                                                                <hr class="mcnDividerContent" style="border-bottom-color:none; border-left-color:none; border-right-color:none; border-bottom-width:0; border-left-width:0; border-right-width:0; margin-top:0; margin-right:0; margin-bottom:0; margin-left:0;" />
                                                -->
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                <tbody class="mcnTextBlockOuter">
                                                                    <tr>
                                                                        <td valign="top" class="mcnTextBlockInner" style="padding-top: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color:#b81717;">
                                                                            <!--[if mso]>
                                                                <table align="left" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
                                                                <tr>
                                                                <![endif]-->
        
                                                                            <!--[if mso]>
                                                                <td valign="top" width="300" style="width:300px;">
                                                                <![endif]-->
                                                                            <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width: 300px;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" width="100%" class="mcnTextContentContainer">
                                                                                <tbody>
                                                                                    <tr>
        
                                                                                        <td valign="top" class="mcnTextContent" style="padding-top: 0;padding-left: 18px;padding-bottom: 9px;padding-right: 18px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;color: #FFFFFF;font-family: Helvetica;font-size: 12px;line-height: 150%;text-align: center;">
        
                                                                                            <p style="text-align: left;"><a href="https://crm.3d-smartsolutions.com/uploads/files/share/Marketing/3DS/Gioi_thieu_cong_ty/3DS_Profile.pdf" target="_blank" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #FFFFFF;font-weight: normal;text-decoration: underline;"><strong>Công ty TNHH 3D Smart Solutions</strong></a><br>                                                                                        Trụ sở chính: 9/9 đường 9, Phường Linh Trung, Tp. Thủ Đức, Tp. HCM<br>
                                                                                                <span style="font-size:12px"></span>Tel:
                                                                                                <a href="tel:02888899039">028 888 99 039</a> ext. 3000<br>Hotmail:
                                                                                                <a href="mailto:cskh@3ds.vn">CSKH@3DS.VN</a>
                                                                                            </p>
        
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                            <!--[if mso]>
                                                                </td>
                                                                <![endif]-->
        
                                                                            <!--[if mso]>
                                                                <td valign="top" width="300" style="width:300px;">
                                                                <![endif]-->
        
                                                                            <!--[if mso]>
                                                                </td>
                                                                <![endif]-->
        
                                                                            <!--[if mso]>
                                                                </tr>
                                                                </table>
                                                                <![endif]-->
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <!--[if (gte mso 9)|(IE)]>
                                                                                    </td>
                                                                                    </tr>
                                                                                    </table>
                                                                                    <![endif]-->
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </center>
        </table>
        </center>