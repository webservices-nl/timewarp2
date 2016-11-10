/**
 * React Starter Kit (https://www.reactstarterkit.com/)
 *
 * Copyright © 2014-2016 Kriasoft, LLC. All rights reserved.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE.txt file in the root directory of this source tree.
 */

import React from 'react';
import FontAwesome from 'react-fontawesome';
import withStyles from 'isomorphic-style-loader/lib/withStyles';
import s from './Header.css';
import Link from '../Link';
import Navigation from '../Navigation';
import logoUrl from './fd-logo.png';

function Header() {
  return (
    <div className={s.root}>
      <section className={s.side}>
        <h1 className={s.title}>FD Media</h1>
        <img className={s.logo} src={logoUrl} />
      </section>
      <section className={s.side}>
        <div className={s.employees}>
          <FontAwesome name='user'/>
          <span className={s.value}>10</span>
        </div>
        <div className={s.profit}>
          <FontAwesome name='usd'/>
          <span className={s.value}>10000</span>
        </div>
        <div className={s.address}>
          <FontAwesome name='address-card' className={s.addressitem}/>
          <ul className={s.addressitem}>
            <li>Prins Bernhardplein 173</li>
            <li>1097 BL AMSTERDAM</li>
          </ul>
        </div>
      </section>
    </div>
  );
}

export default withStyles(s)(Header);
